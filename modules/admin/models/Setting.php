<?php

namespace app\modules\admin\models;

use yii\base\Model;

/**
 * Description of Setting
 *
 */
class Setting extends Model
{
    /**
     * {@inheritdoc}
     */
    public $adminEmail;
    public $pageSizeBack;
    public $pageSizeFront;
    public $urlParse;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['adminEmail', 'urlParse'], 'string', 'max' => 255],
            [['pageSizeBack', 'pageSizeFront'], 'integer'],
            [['adminEmail'], 'email'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'adminEmail' => 'Email адрес получателя сообщения с формы обратной связи',
            'pageSizeBack' => 'Кол-во элементов на страницу в админке (для книг)',
            'pageSizeFront' => 'Кол-во элементов на страницу на сайте (для книг)',
            'urlParse' => 'Источник данных для парсинга (url)',
        ];
    }
    
    public function setSettings()
    {
        \Yii::$app->settings->set('admin.adminEmail', $this->adminEmail);
        \Yii::$app->settings->set('admin.pageSizeBack', (int) $this->pageSizeBack);
        \Yii::$app->settings->set('admin.pageSizeFront', (int) $this->pageSizeFront);
        \Yii::$app->settings->set('admin.urlParse', $this->urlParse);
    }
}
