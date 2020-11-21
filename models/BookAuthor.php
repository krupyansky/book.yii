<?php 

namespace app\models;

use yii\db\ActiveRecord;

class BookAuthor extends ActiveRecord
{
    public static function tableName()
    {
        return 'book_author';
    }
    
    public function rules()
    {
        return [
            [['book_id', 'author_id'], 'integer'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    public function getIdBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    public function getIdAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }
}
