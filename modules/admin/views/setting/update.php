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

    <?= $form->field($model, 'pageSizeBack')->textInput(['maxlength' => true, 'value' => \Yii::$app->settings->get('admin.pageSizeBack')]) ?>
    
    <?= $form->field($model, 'pageSizeFront')->textInput(['maxlength' => true, 'value' => \Yii::$app->settings->get('admin.pageSizeFront')]) ?>

    <?= $form->field($model, 'adminEmail')->textInput(['maxlength' => true, 'value' => \Yii::$app->settings->get('admin.adminEmail')]) ?>

    <?= $form->field($model, 'urlParse')->textInput(['maxlength' => true, 'value' => \Yii::$app->settings->get('admin.urlParse')]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
