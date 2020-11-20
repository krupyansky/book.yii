<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\admin\models\BookCategory;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $parentID
 * @property string $title
 *
 * @property BookCategory[] $bookCategories
 * @property Book[] $books
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    protected static $trunkParentId = [];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parentID'], 'integer'],
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parentID' => 'Родительская категория',
            'title' => 'Название',
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'parentID']);
    }

    /**
     * Gets query for [[BookCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookCategories()
    {
        return $this->hasMany(BookCategory::class, ['category_id' => 'id']);
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])->viaTable('book_category', ['category_id' => 'id']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                Yii::$app->session->setFlash('success', 'Категория успешно добавлена!');
            } else {
                $category_id = $this->id;
                $formParentID = $this->parentID;
                $parentID = Category::find()->where(['id' => $category_id])->select('parentID')->one()->parentID;
                $trunkParentId = self::getCategoryTrunkParentId($category_id);
                self::$trunkParentId = array();
                if ($formParentID != $parentID) {
                    $dataBookId = BookCategory::find()->where(['category_id' => $category_id])->select('book_id')->asArray()->all();
                    if (count($trunkParentId) != 1) {
                        foreach ($dataBookId as $key => $bookId) {
                            foreach ($trunkParentId as $parentID) {
                                if ($parentID == $category_id) {
                                    continue;
                                }
                                if (BookCategory::find()->where(['book_id' => $bookId['book_id']])->andWhere(['category_id' => $parentID])->exists()) {
                                    BookCategory::find()->where(['book_id' => $bookId['book_id']])->andWhere(['category_id' => $parentID])->one()->delete();
                                }
                            }
                        }
                    }
                    if ($formParentID != 0) {
                        $trunkParentId = self::getCategoryTrunkParentId($formParentID);
                        foreach ($dataBookId as $key => $bookId) {
                            foreach ($trunkParentId as $parentID) {
                                $model = new BookCategory();
                                $model->book_id = $bookId['book_id'];
                                $model->category_id = $parentID;
                                if(!$model->save()){
                                    return false;
                                }
                            }
                        }
                    }
                    Yii::$app->session->setFlash('success', 'Категория успешно обновлена!');
                }
            }
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public static function getCategoryTrunkParentId($id)
    {
        $category = Category::findOne($id);
        array_unshift(Category::$trunkParentId, $category->id);
        if ($category->parentID != 0){
            Category::getCategoryTrunkParentId($category->parentID);
        }
        return Category::$trunkParentId;
    }
}
