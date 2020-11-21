<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель, отвечающая за формирование таблица order_book
 *
 */
class OrderBook extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'order_book';
    }
    
    public function rules()
    {
        return [
            [['order_id', 'book_id', 'title', 'qty'], 'required'],
            [['order_id', 'book_id', 'qty'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }
    
    public function saveOrderBooks($books, $order_id)
    {
        foreach ($books as $id => $book){
            $this->id = null;
            $this->isNewRecord = true;
            $this->order_id = $order_id;
            $this->book_id = $id;
            $this->title = $book['title'];
            $this->qty = $book['qty'];
            if(!$this->save()){
                return false;
            }
        }
        return true;
    }
}
