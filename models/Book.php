<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель, отвечающая за работу продуктов
 *
 */
class Book extends ActiveRecord
{
    public static function tableName() 
    {
        return 'book';
    }
    
    public function rules()
    {
        return [
            [['title', 'isbn', 'status'], 'required'],
            [['publishedDate'], 'safe'],
            [['pageCount'], 'integer'],
            [['isbn', 'thumbnailUrl', 'shortDescription', 'longDescription', 'status'], 'string'],
        ];
    }
    
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::class, ['book_id' => 'id']);
    }
    
    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])->via('bookAuthors');
    }

    public function getBookCategories()
    {
        return $this->hasMany(BookCategory::class, ['book_id' => 'id']);
    }
    
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->via('bookCategories');
    }
}
