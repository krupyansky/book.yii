<?php 

namespace app\models;

use yii\db\ActiveRecord;

class Productcategory extends ActiveRecord
{
    public static function tableName()
    {
            return 'book_category';
    }

    public function rules()
    {
        return [
            [['book_id', 'category_id'], 'integer'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['book_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function getIdProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'book_id']);
    }

    public function getIdCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
