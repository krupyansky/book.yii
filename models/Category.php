<?php 

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель, отвечающая за работу категорий
 *
 */
class Category extends ActiveRecord
{
    protected static $breadcrumbs = [];
    
    public static function tableName()
    {
        return 'category';
    }
    
    public function rules()
    {
        return [
            [['parentID', 'title'], 'required'],
            [['parentID'], 'integer'],
            [['title'], 'string'],
        ];
    }
    
    public function getProductcategories()
    {
        return $this->hasMany(Productcategory::className(), ['category_id' => 'id']);
    }
    
    public static function getBreadcrumbs($id)
    {
        $category = Category::findOne($id);
        array_unshift(Category::$breadcrumbs, $category);
        if ($category->parentID != 0){
            Category::getBreadcrumbs($category->parentID);
        }
        return Category::$breadcrumbs;
    }
}
