<?php

namespace app\controllers;

use app\models\Product;
use app\models\Cart;
use app\models\Order;
use app\models\OrderProduct;
use app\models\OrderMail;

/**
 * Контроллер, отвечающий за работу корзины
 *
 */
class CartController extends AppController
{
    public function actionAdd($id) 
    {
        $product = Product::findOne($id);
        if(empty($product)){
            return false;
        }
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product);
        if(\Yii::$app->request->isAjax){
            return $this->renderPartial('cart-modal', compact('session'));
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }
    
    public function actionShow()
    {
        $session = \Yii::$app->session;
        $session->open();
        return $this->renderPartial('cart-modal', compact('session'));
    }
    
    public function actionDelItem($id)
    {
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        if(\Yii::$app->request->isAjax){
            return $this->renderPartial('cart-modal', compact('session'));
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }
    
    public function actionClear() 
    {
        $session = \Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        return $this->renderPartial('cart-modal', compact('session'));
    }
    
    public function actionChangeCart($id, $qty) 
    {
        $product = Product::findOne($id);
        if(empty($product)){
            return false;
        }
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        return $this->renderPartial('cart-modal', compact('session'));
    }
    
    public function actionView()
    {
        $this->setMeta(\Yii::$app->name . " | Корзина");
        $session = \Yii::$app->session;
        return $this->render('view', compact('session'));
    }
    
    public function actionCheckout()
    {
        $this->setMeta(\Yii::$app->name . " | Оформление заказа");
        $session = \Yii::$app->session;
        
        $order = new Order();
        $order_product = new OrderProduct();
        $order_mail = new OrderMail();
        if($order->load(\Yii::$app->request->post())){
            $transaction = \Yii::$app->getDb()->beginTransaction();
            if(!$order->save() || !$order_product->saveOrderProducts($session['cart'], $order->id)){
                \Yii::$app->session->setFlash('error', 'Ошибка оформления заказа!');
                $transaction->rollBack();
            }else{
                $transaction->commit();
                \Yii::$app->session->setFlash('success', 'Заказ успешно принят!');
                
                try {
                    \Yii::$app->mailer->compose('order', ['session' => $session])
                    ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
                    ->setTo([$order->email, \Yii::$app->settings->get('admin.adminEmail')])
                    ->setSubject('Заказ в книжном каталоге')
                    ->send();
                    $mail = \Yii::$app->mailer->render('@app/mail/order', ['session' => $session], false);
                    $order_mail->saveOrderMail($mail, $order->id);
                } catch(\Swift_TransportException $e) {
                    print_r($e); die;
                }
                
                $session->remove('cart');
                $session->remove('cart.qty');
                return $this->refresh();
            }
        }
        return $this->render('checkout', compact('session', 'order'));
    }
}
