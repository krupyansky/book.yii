<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "order_product".
 *
 * @property int $id
 * @property int $order_id
 * @property int $book_id
 * @property string $title
 * @property int $qty
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'book_id', 'title', 'qty'], 'required'],
            [['order_id', 'book_id', 'qty'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'book_id' => 'Book ID',
            'title' => 'Title',
            'qty' => 'Qty',
        ];
    }
}
