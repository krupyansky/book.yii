<?php

namespace app\controllers;

use app\models\Book;
use app\models\Category;
use yii\web\NotFoundHttpException;

/**
 * Контроллер, отвечающий за детальный просмотр продукта
 *
 */
class BookController extends AppController
{
    public function actionView($id) 
    {
        $book = Book::find()->joinWith('authors')->andFilterWhere(['book.id' => $id])->one();
        $categories = Book::findOne($id)->getBookCategories()->with('idCategory')->asArray()->all();
        $category_id = $categories[count($categories)-1]['idCategory']['id'];
        $related_books = Category::findOne($category_id)->getBookCategories()->with('idBook')->asArray()->limit(9)->all();
        if (empty($book)) {
            throw new NotFoundHttpException('Книга отсутствует...');
        }
        $this->setMeta(\Yii::$app->name . " | {$book->title}");
        return $this->render('view', compact('book', 'categories', 'related_books'));
    }
}
