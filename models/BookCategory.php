<?php 

namespace app\models;

use yii\db\ActiveRecord;

class BookCategory extends ActiveRecord
{
    public static function tableName()
    {
            return 'book_category';
    }

    public function rules()
    {
        return [
            [['book_id', 'category_id'], 'integer'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function getIdBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    public function getIdCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}
