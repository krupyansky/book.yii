<?php

namespace app\controllers;

use app\models\Product;
use app\models\Category;
use yii\web\NotFoundHttpException;

/**
 * Контроллер, отвечающий за детальный просмотр продукта
 *
 */
class ProductController extends AppController
{
    public function actionView($id) 
    {
        $product = Product::find()->joinWith('authors')->andFilterWhere(['book.id' => $id])->one();
        $categories = Product::findOne($id)->getProductcategories()->with('idCategory')->asArray()->all();
        $category_id = $categories[count($categories)-1]['idCategory']['id'];
        $related_products = Category::findOne($category_id)->getProductcategories()->with('idProduct')->asArray()->limit(9)->all();
        if (empty($product)) {
            throw new NotFoundHttpException('Продукт отсутствует...');
        }
        $this->setMeta(\Yii::$app->name . " | {$product->title}");
        return $this->render('view', compact('product', 'categories', 'related_products'));
    }
}
