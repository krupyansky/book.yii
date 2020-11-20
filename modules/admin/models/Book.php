<?php

namespace app\modules\admin\models;

use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property string $isbn
 * @property int|null $pageCount
 * @property string|null $publishedDate
 * @property string|null $thumbnailUrl
 * @property string|null $shortDescription
 * @property string|null $longDescription
 * @property string $status
 *
 * @property BookAuthor[] $bookAuthors
 * @property Author[] $authors
 * @property BookCategory[] $bookCategories
 * @property Category[] $categories
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $imageFile;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'isbn', 'status'], 'required'],
            [['pageCount'], 'integer'],
            [['publishedDate'], 'safe'],
            [['shortDescription', 'longDescription'], 'string'],
            [['title', 'isbn', 'thumbnailUrl', 'status'], 'string'],
            [['isbn'], 'unique'],
            [['thumbnailUrl'], 'default', 'value' => 'books/no-image.jpg'],
            [['imageFile'], 'image'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'isbn' => 'ISBN',
            'pageCount' => 'Кол-во страниц',
            'publishedDate' => 'Дата публикации',
            'thumbnailUrl' => 'Изображение',
            'imageFile' => 'Изображение',
            'shortDescription' => 'Краткое описание',
            'longDescription' => 'Подробное описание',
            'status' => 'Статус',
            'authors' => 'Авторы',
            'categories' => 'Категории',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::class, ['book_id' => 'id']);
    }

    /**
     * Gets query for [[Authors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])->viaTable('book_author', ['book_id' => 'id']);
    }

    /**
     * Gets query for [[BookCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookCategories()
    {
        return $this->hasMany(BookCategory::class, ['book_id' => 'id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->viaTable('book_category', ['book_id' => 'id']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) 
    {
        if ($imageFile = UploadedFile::getInstance($this, 'imageFile')) {
            $dir = 'books/' . date("Y-m-d") . '/';
            if (!is_dir($dir)) {
                mkdir($dir);
            }
            $imageFileName = uniqid() . '_' . $imageFile->baseName . '.' . $imageFile->extension;
            $this->thumbnailUrl = $dir . $imageFileName;
            $imageFile->saveAs($this->thumbnailUrl);
        }
        
        return parent::beforeSave($insert);
    }
    
    /**
     * {@inheritdoc}
     */
    public function afterSave($insert, $changedAttributes) {
        $category_id = Yii::$app->request->post('category_id');
        $authors = Yii::$app->request->post('authors');
        $trunkParentID = Category::getCategoryTrunkParentId($category_id);
        $book_id = $this->id;
        if ($insert) {
            Yii::$app->session->setFlash('success', 'Книга успешно добавлена!');
        } else {
            Book::findOne($book_id)->unlinkAll('bookCategories', true);
            Book::findOne($book_id)->unlinkAll('bookAuthors', true);
            Yii::$app->session->setFlash('success', 'Книга успешно обновлена!');
        }
        foreach ($trunkParentID as $parentID) {
            $book_category = new BookCategory();
            if ($book_category->load(['book_id' => $book_id, 'category_id' => $parentID], '')) {
                $transaction = Yii::$app->getDb()->beginTransaction();
                if (!$book_category->save()) {
                    $transaction->rollBack();
                } else {
                    $transaction->commit();
                }
            }
        }
        foreach ($authors as $author) {
            $book_author = new BookAuthor();
            if ($book_author->load(['book_id' => $book_id, 'author_id' => $author], '')) {
                $transaction = Yii::$app->getDb()->beginTransaction();
                if (!$book_author->save()) {
                    $transaction->rollBack();
                } else {
                    $transaction->commit();
                }
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
