<?php 

namespace app\controllers;

use yii\web\Controller;

/**
 * General Controller Class
 * 
 */
class AppController extends Controller
{
    public function beforeAction($action)
    {
        $this->view->title = \Yii::$app->name;
        return parent::beforeAction($action);
    }
    
    /**
     * Устанавливает title и регистрирует мета-теги.
     *
     * @return void
     */
    protected function setMeta($title = null, $keywords = null, $description = null) 
    {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $description]);
    }
}
