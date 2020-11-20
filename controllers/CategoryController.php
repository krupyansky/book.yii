<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;

/**
 * Контроллер, отвечающий за отображение категорий и поиск товаров
 *
 */
class CategoryController extends AppController
{
    public function actionView($id)
    {
        $filter_title_book = trim(\Yii::$app->request->get('title_book'));
        $filter_name_author = trim(\Yii::$app->request->get('name_author'));
        $filter_status_book = strtoupper(trim(\Yii::$app->request->get('status_book')));
        
        $category = Category::findOne($id);
        $subcategories = Category::find()->where(['parentID' => $id])->select('id, title')->all();
        if(empty($category)){
            throw new \yii\web\NotFoundHttpException('Категория отсутствует...');
        }    
        $this->setMeta(\Yii::$app->name . " | {$category->title}");
        
        if($filter_title_book){
            $query = Product::find()->joinWith('productcategories')->andFilterWhere(['book_category.category_id' => $id])->andFilterWhere(['like', 'book.title', $filter_title_book]);
        } elseif($filter_name_author){
            $query = Product::find()->joinWith('productcategories')->joinWith('authors')->andFilterWhere(['book_category.category_id' => $id])->andFilterWhere(['like', 'author.name', $filter_name_author]);
        } elseif($filter_status_book){
            $query = Product::find()->joinWith('productcategories')->andFilterWhere(['book_category.category_id' => $id, 'book.status' => $filter_status_book]);
        } else {
            $query = Product::find()->joinWith('productcategories')->andFilterWhere(['book_category.category_id' => $id]);
        }  
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 20, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        $breadcrumbs = Category::getBreadcrumbs($id);
        $options = Product::find()->joinWith('productcategories')->andFilterWhere(['book_category.category_id' => $id])->select('book.status')->distinct()->all();
        return $this->render('view', compact('category', 'subcategories', 'products', 'breadcrumbs', 'pages', 'options'));
    }
    
    public function actionSearch() 
    {
        $search = trim(\Yii::$app->request->get('search'));
        $this->setMeta(\Yii::$app->name . " | Поиск: {$search}");
        if(!$search){
            return $this->render('search');
        }
        $query = Product::find()->where(['like', 'title', $search]);
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 20, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('products', 'search', 'pages'));
    }
}
