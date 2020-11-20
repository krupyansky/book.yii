<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель, отвечающая за формирование таблица order_product
 *
 */
class OrderProduct extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'order_product';
    }
    
    public function rules()
    {
        return [
            [['order_id', 'book_id', 'title', 'qty'], 'required'],
            [['order_id', 'book_id', 'qty'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }
    
    public function saveOrderProducts($products, $order_id)
    {
        foreach ($products as $id => $product){
            $this->id = null;
            $this->isNewRecord = true;
            $this->order_id = $order_id;
            $this->book_id = $id;
            $this->title = $product['title'];
            $this->qty = $product['qty'];
            if(!$this->save()){
                return false;
            }
        }
        return true;
    }
}
