<?php

namespace app\controllers;

use app\models\Category;
use app\models\Book;

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
            $query = Book::find()->joinWith('bookCategories')->andFilterWhere(['book_category.category_id' => $id])->andFilterWhere(['like', 'book.title', $filter_title_book]);
        } elseif($filter_name_author){
            $query = Book::find()->joinWith('bookCategories')->joinWith('authors')->andFilterWhere(['book_category.category_id' => $id])->andFilterWhere(['like', 'author.name', $filter_name_author]);
        } elseif($filter_status_book){
            $query = Book::find()->joinWith('bookCategories')->andFilterWhere(['book_category.category_id' => $id, 'book.status' => $filter_status_book]);
        } else {
            $query = Book::find()->joinWith('bookCategories')->andFilterWhere(['book_category.category_id' => $id]);
        }  
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => \Yii::$app->settings->get('admin.pageSizeFront'), 'forcePageParam' => false, 'pageSizeParam' => false]);
        $books = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        $breadcrumbs = Category::getBreadcrumbs($id);
        $options = Book::find()->joinWith('bookCategories')->andFilterWhere(['book_category.category_id' => $id])->select('book.status')->distinct()->all();
        return $this->render('view', compact('category', 'subcategories', 'books', 'breadcrumbs', 'pages', 'options'));
    }
    
    public function actionSearch() 
    {
        $search = trim(\Yii::$app->request->get('search'));
        $this->setMeta(\Yii::$app->name . " | Поиск: {$search}");
        if(!$search){
            return $this->render('search');
        }
        $query = Book::find()->where(['like', 'title', $search]);
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => \Yii::$app->settings->get('admin.pageSizeFront'), 'forcePageParam' => false, 'pageSizeParam' => false]);
        $books = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('books', 'search', 'pages'));
    }
}
