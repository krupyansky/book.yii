<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group field-category-parentID">
        <label class="control-label" for="category-parentID">Родительская категория</label>
        <select id="category-parentID" class="form-control" name="Category[parentID]" aria-invalid="false">
            <option value="0" selected="">Родительская категория</option>
            <?= app\components\MenuWidget::widget([
                'template' => 'select_category',
                'model' => $model,
                'cache_time' => 0,
            ]) ?>
        </select> 
        <div><div class="help-block"></div></div>       
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
