<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Book */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить эту книгу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'isbn',
            'pageCount',
            'publishedDate',
            [
                'attribute' => 'Изображение',
                'value' => "/{$model->thumbnailUrl}",
                'format' => ['image', ['width' => 150]],
            ],
            [
                'attribute' => 'Авторы',
                'value' => function($data) {
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
                'attribute' => 'Категории',
                'value' => function($data) {
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
            'shortDescription:ntext',
            'longDescription:ntext',
            'status',
        ],
    ]) ?>

</div>
