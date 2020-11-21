<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Book */

$this->title = "Настройки";
//$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="setting-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update'], ['class' => 'btn btn-primary']) ?>
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr>
                <th>Кол-во элементов на страницу в админке (для книг)</th>
                <td><?= \Yii::$app->settings->get('admin.pageSizeBack') ?></td>
            </tr>
            <tr>
                <th>Кол-во элементов на страницу на сайте (для книг)</th>
                <td><?= \Yii::$app->settings->get('admin.pageSizeFront') ?></td>
            </tr>
            <tr>
                <th>Email адрес получателя сообщения с формы обратной связи</th>
                <td><?= \Yii::$app->settings->get('admin.adminEmail') ?></td>
            </tr>
            <tr>
                <th>Источник данных для парсинга (url)</th>
                <td><?= \Yii::$app->settings->get('admin.urlParse') ?></td>
            </tr>
        </tbody>
    </table>

</div>
