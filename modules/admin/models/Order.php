<?php

namespace app\modules\admin\models;

use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $email
 * @property string|null $name
 * @property string $note
 * @property string|null $phone
 * @property string $created_at
 * @property string $updated_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'note', 'created_at', 'updated_at'], 'required'],
            [['note'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['email', 'name', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'E-mail',
            'name' => 'Имя',
            'note' => 'Сообщение',
            'phone' => 'Телефон',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function getOrderProduct()
    {
        return $this->hasMany(OrderProduct::class, ['order_id' => 'id']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getOrderMail()
    {
        return $this->hasOne(OrderMail::class, ['order_id' => 'id']);
    }
}
