<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use kartik\file\FileInput;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;

mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group field-book-category_id">
        <label class="control-label" for="book-category_id">Категория</label>
        <select id="book-category_id" class="form-control" name="category_id" aria-invalid="false">
            <?= app\components\MenuWidget::widget([
                'template' => 'select_book_category',
                'model' => array_pop($model->categories),
                'cache_time' => 0,
            ]) ?>
        </select> 
        <div><div class="help-block"></div></div>       
    </div>
    
    <div class="form-group field-book-authors">
        <label class="control-label" for="book-authors">Авторы</label>
        <input type="hidden" name="authors" value="">
        <select id="book-authors" class="form-control" name="authors[]" multiple="multiple" size="6" aria-required="true">
            <?php foreach ($authors as $author): ?>
            <option value="<?= $author->id ?>"><?= $author->name ?></option>
            <?php endforeach; ?>
        </select>

        <div class="help-block"></div>
    </div>
    
    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pageCount')->textInput() ?>
    
    <?php 
        echo $form->field($model, 'publishedDate')->widget(DateTimePicker::class,[
            'name' => 'dp_1',
            'type' => DateTimePicker::TYPE_INPUT,
            'options' => ['placeholder' => 'Ввод даты/времени...'],
            'convertFormat' => true,
            'value'=> date("d.m.Y h:i:s",(integer) $model->publishedDate),
            'pluginOptions' => [
                'format' => 'yyyy-MM-dd hh:i:ss',
                'autoclose'=>true,
                'weekStart'=>1, //неделя начинается с понедельника
                'startDate' => '01.01.1970 00:00', //самая ранняя возможная дата
                'todayBtn'=>true, //снизу кнопка "сегодня"
            ]
        ]);
    ?>
    
    <?php 
        echo $form->field($model, 'imageFile')->widget(FileInput::class, [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showCaption' => false,
                'showUpload' => false,
            ],
        ]);
    ?>

    <?= 
        $form->field($model, 'shortDescription')->widget(CKEditor::class, [
            'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[/* Some CKEditor Options */]),
        ]);
    ?>
    
    <?= 
        $form->field($model, 'longDescription')->widget(CKEditor::class, [
            'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[/* Some CKEditor Options */]),
        ]);
    ?>

    <?= $form->field($model, 'status')->dropDownList(['PUBLISH' => 'PUBLISH', 'MEAP' => 'MEAP']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
