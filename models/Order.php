<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * Модель, отвечающая за оформление заказа
 *
 */
class Order extends ActiveRecord
{
    public $reCaptcha;
    
    public static function tableName(): string 
    {
        return 'order';
    }
    
    public function rules()
    {
        return [
            [['email', 'note'], 'required'],
            [['email', 'name', 'note'], 'string'],
            [['email'], 'email'],
            [['phone'], 'udokmeci\yii2PhoneValidator\PhoneValidator' ,'country' => 'RU'],
            [['created_at', 'updated_at'], 'safe'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::class, 
                'secret' => '6LfKY-QZAAAAABubs3VnUoskP4ekHrKS1iaCMr2b', 
                'uncheckedMessage' => 'Пожалуйста, подтвердите принадлежность к человеческому роду'
            ],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'E-mail (обязательное поле)',
            'phone' => 'Номер телефона',
            'note' => 'Сообщение (обязательное поле)',
            'reCaptcha' => '',
        ];
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
