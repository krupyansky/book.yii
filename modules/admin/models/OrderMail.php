<?php

namespace app\modules\admin\models;

/**
 * This is the model class for table "order_mail".
 *
 * @property int $id
 * @property int $order_id
 * @property string $content
 */
class OrderMail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_mail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'content'], 'required'],
            [['order_id'], 'integer'],
            [['content'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'content' => 'Content',
        ];
    }
}
