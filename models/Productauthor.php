<?php 

namespace app\models;

use yii\db\ActiveRecord;

class Productauthor extends ActiveRecord
{
    public static function tableName()
    {
            return 'book_author';
    }
    
    public function rules()
    {
        return [
            [['book_id', 'author_id'], 'integer'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['book_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    public function getIdProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'book_id']);
    }

    public function getIdAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }
}
