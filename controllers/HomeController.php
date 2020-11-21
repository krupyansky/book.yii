<?php 

namespace app\controllers;

use app\models\Book;

/**
 * Контроллер, отвечающий за отображение главной страницы
 *
 */
class HomeController extends AppController
{
    public function actionIndex()
    {
        $last_books = Book::find()->orderBy('id desc')->limit(10)->all();
        $this->setMeta(\Yii::$app->name . " | Главная");
        return $this->render('index', compact('last_books'));
    }
}
