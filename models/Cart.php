<?php

namespace app\models;

use yii\base\Model;

/**
 * Модель, отвечающая за работу корзины
 *
 */
class Cart extends Model
{
    public function addToCart($product, $qty = 1) 
    {
        if ($qty == '-1'){
            $qty = -1;
        } else {
            $qty = 1;
        }
        if (isset($_SESSION['cart'][$product->id])){
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$product->id] = [
                'title' => $product->title,
                'qty' => $qty,
                'img' => $product->thumbnailUrl,
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        if ($_SESSION['cart'][$product->id]['qty'] == 0){
            unset($_SESSION['cart'][$product->id]);
        }
    }
    
    public function recalc($id)
    {
        if(!isset($_SESSION['cart'][$id])){
            return false;
        }
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $_SESSION['cart.qty'] -= $qtyMinus;
        unset($_SESSION['cart'][$id]);
    } 
}
