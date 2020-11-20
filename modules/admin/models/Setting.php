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
    public $pageSize;
    public $urlParse;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['adminEmail', 'urlParse'], 'string', 'max' => 255],
            [['pageSize'], 'integer'],
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
            'pageSize' => 'Кол-во элементов на страницу (для книг)',
            'urlParse' => 'Источник данных для парсинга (url)',
        ];
    }
    
    public function setSettings()
    {
        \Yii::$app->settings->set('admin.adminEmail', $this->adminEmail);
        \Yii::$app->settings->set('admin.pageSize', (int) $this->pageSize);
        \Yii::$app->settings->set('admin.urlParse', $this->urlParse);
    }
}
