<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель, отвечающая за работу продуктов
 *
 */
class Product extends ActiveRecord
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
    
    public function getProductauthors()
    {
        return $this->hasMany(Productauthor::className(), ['book_id' => 'id']);
    }
    
    public function getAuthors()
    {
        return $this->hasMany(Author::className(), ['id' => 'author_id'])->via('productauthors');
    }

    public function getProductcategories()
    {
        return $this->hasMany(Productcategory::className(), ['book_id' => 'id']);
    }
    
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->via('productcategories');
    }
}
