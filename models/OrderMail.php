<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * OrderMail Model
 *
 */
class OrderMail extends ActiveRecord
{
    public static function tableName(): string 
    {
        return 'order_mail';
    }
    
    public function rules()
    {
        return [
            [['order_id', 'content'], 'required'],        
            [['order_id'], 'integer'],
            [['content'], 'string'],
        ];
    }
    
    public function saveOrderMail($mail, $order_id)
    {
        $this->id = null;
        $this->isNewRecord = true;
        $this->order_id = $order_id;
        $this->content = $mail;
        if(!$this->save()){
            return false;
        }
        return true;
    }
}
