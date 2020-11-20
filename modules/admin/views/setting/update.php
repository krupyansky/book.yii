<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */

$this->title = "Редактировать настройки";
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['view']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pageSize')->textInput(['maxlength' => true, 'value' => \Yii::$app->settings->get('admin.pageSize')]) ?>
    <?//= $form->field($model, 'pageSize')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adminEmail')->textInput(['maxlength' => true, 'value' => \Yii::$app->settings->get('admin.adminEmail')]) ?>
    <?//= $form->field($model, 'adminEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'urlParse')->textInput(['maxlength' => true, 'value' => \Yii::$app->settings->get('admin.urlParse')]) ?>
    <?//= $form->field($model, 'urlParse')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
