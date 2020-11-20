<?php

namespace app\commands;

use yii\console\Controller;
use app\models\Product;
use app\models\Author;
use app\models\Category;
use app\models\Productauthor;
use app\models\Productcategory;

/**
 * Парсит книги из файла json в БД
 *
 */
class ParserController extends Controller
{
    /**
     * Запуск парсинга
     *
     * @return void
     */
    public function actionRun()
    {
        $urlParse = \Yii::$app->settings->get('admin.urlParse');
        $ch = curl_init($urlParse);
        $fp = fopen(__DIR__ . '/books.json', 'wb');

        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        $res = file_get_contents(__DIR__ . '/books.json');
        $data = json_decode($res, true);

        $extension_list = ['jpg', 'jpeg', 'png'];

        foreach ($data as $datum) {
            // insert to book table
            $book = new Product();
            $book_arr = array_diff_key($datum, array_flip([
                'authors',
                'categories',
            ]));
            
            if (isset($book_arr['publishedDate'])) {
                $book_arr['publishedDate'] = substr($book_arr['publishedDate']['$date'], 0, 10);
            }
            
            if (isset($book_arr['isbn']) && !Product::find()->where(['isbn' => $book_arr['isbn']])->exists() && $book->load($book_arr, '')) {
                // add images
                if (isset($datum['thumbnailUrl'])) {
                    $pos_dot = strrpos($datum['thumbnailUrl'], '.') + 1;
                    $pos_slash = strrpos($datum['thumbnailUrl'], '/') + 1;
                    $image_extension = substr($datum['thumbnailUrl'], $pos_dot);
                    $image_name = substr($datum['thumbnailUrl'], $pos_slash, $pos_dot - $pos_slash - 1);
                    if (in_array($image_extension, $extension_list) || strlen($image_name) > 0) {
                        $dir = __DIR__ . '/../web/books/' . date("Y-m-d");
                        if (!is_dir($dir)) mkdir($dir, 0777, true);

                        $image_name = uniqid() . '_' . $image_name . '.' . $image_extension;

                        $ch = curl_init($datum['thumbnailUrl']);
                        $fp = fopen($dir . '/' . $image_name, 'wb');

                        curl_setopt($ch, CURLOPT_FILE, $fp);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_exec($ch);
                        curl_close($ch);
                        fclose($fp);

                        $book->thumbnailUrl = 'books/' . date("Y-m-d") . '/' . $image_name;
                    } else {
                        $book->thumbnailUrl = 'books/no-image.jpg';
                    }
                } else {
                    $book->thumbnailUrl = 'books/no-image.jpg';    
                }

                $transaction = \Yii::$app->getDb()->beginTransaction();
                if (!$book->save()) {
                    $transaction->rollBack();
                } else {
                    $last_book_id = $book->id;
                    $transaction->commit();

                    // insert to author table
                    self::insertAuthor($datum['authors'], $last_book_id);

                    // insert to category table
                    self::insertCategory($datum['categories'], $last_book_id);
                }
            }
        }
    }

    /**
     * Добавляет авторов данной книг в БД.
     *  
     * @param array $author_arr - массив авторов данной книги
     * @param integer $last_book_id - id данной книги
     * @return void
     */
    protected function insertAuthor($author_arr, $last_book_id)
    {
        foreach ($author_arr as $author_name) {
            $author = new Author();
            if ($author_name == '' || strlen($author_name) < 3) continue;
            if ($author->load(['name' => $author_name], '')) {
                $last_author_id = 0;
                if (!Author::find()->where(['name' => $author_name])->exists()) {
                    $transaction = \Yii::$app->getDb()->beginTransaction();
                    if (!$author->save()) {
                        $transaction->rollBack();
                    } else {
                        $last_author_id = $author->id;
                        $transaction->commit();
                    }
                } else {
                    $last_author_id = Author::findOne(['name' => $author_name])->id;
                }

                // insert to book_author table
                if ($last_author_id != 0) self::insertProductauthor($last_book_id, $last_author_id);
            }
        }
    }

    /**
     * Добавляет данные в промежуточную таблицу для связи данной книги с ее авторами/автором
     *  
     * @param integer $last_book_id - id данной книги
     * @param integer $last_author_id - id автора данной книги
     * @return void
     */
    protected function insertProductauthor($last_book_id, $last_author_id)
    {
        $book_author = new Productauthor;
        if ($book_author->load(['book_id' => $last_book_id, 'author_id' => $last_author_id], '')) {
            $transaction = \Yii::$app->getDb()->beginTransaction();
            if (!$book_author->save()) {
                $transaction->rollBack();
            } else {
                $transaction->commit();
            }
        }
    }

    /**
     * Формирует иерархию категорий данной книги и добавляет их в БД.
     *  
     * @param array $category_arr - массив категорий данной книги
     * @param integer $last_book_id - id данной книги
     * @return void
     */
    protected function insertCategory($category_arr, $last_book_id)
    {
        $parent_id = 0;
        if (count($category_arr) != 0) {
            foreach ($category_arr as $category_name) {
                $category = new Category();
                if ($category_name == '') continue;
                if ($category->load(['parentID' => $parent_id,'title' => $category_name], '')) {
                    $last_category_id = 0;
                    
                    if (!Category::find()->where(['parentID' => $parent_id, 'title' => $category_name])->exists()) {
                        $transaction = \Yii::$app->getDb()->beginTransaction();
                        if (!$category->save()) {
                            $transaction->rollBack();
                        } else {
                            $last_category_id = $category->id;
                            $parent_id = $last_category_id;

                            $transaction->commit();
                        }
                    } else {
                        $last_category_id = Category::findOne(['parentID' => $parent_id,'title' => $category_name])->id;
                        $parent_id = $last_category_id;
                    }

                    // insert to book_author table
                    if ($last_category_id != 0) self::insertProductcategory($last_book_id, $last_category_id);
                }
            }
        } else {
            $last_category_id = 1;
            self::insertProductcategory($last_book_id, $last_category_id);
        }  
    }

    /**
     * Добавляет данные в промежуточную таблицу для связи данной книги с ее категориями/категорией
     *  
     * @param integer $last_book_id - id данной книги
     * @param integer $last_category_id - id категории данной книги
     * @return void
     */
    protected function insertProductcategory($last_book_id, $last_category_id)
    {
        $book_category = new Productcategory;
        if ($book_category->load(['book_id' => $last_book_id, 'category_id' => $last_category_id], '')) {
            $transaction = \Yii::$app->getDb()->beginTransaction();
            if (!$book_category->save()) {
                $transaction->rollBack();
            } else {
                $transaction->commit();
            }
        }
    }
}
