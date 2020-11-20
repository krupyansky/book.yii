<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            'isbn',
            'pageCount',
            'publishedDate',
            'status',
            [
                'attribute' => 'authors',
                'value' => function($data){
                    $str = '';
                    $len = count($data->authors);
                    foreach($data->authors as $author){
                        --$len;
                        if (!$len) {
                            $str .= "{$author->name}";
                        } else {
                            $str .= "{$author->name}, ";
                        }
                    }
                    return $str;
                },
            ],
            [
                'attribute' => 'categories',
                'value' => function($data){
                    $str = '';
                    $len = count($data->categories);
                    foreach($data->categories as $category){
                        --$len;
                        if (!$len) {
                            $str .= "{$category->title}";
                        } else {
                            $str .= "{$category->title} > ";
                        }
                    }
                    return $str;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
</div>
