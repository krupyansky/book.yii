<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель, отвечающая за таблицу авторов книг
 *
 */
class Author extends ActiveRecord
{
    public static function tableName() 
    {
        return 'author';
    }
    
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
        ];
    }
    
    public function getProductauthors()
    {
        return $this->hasMany(Productauthor::className(), ['author_id' => 'id']);
    }
}
