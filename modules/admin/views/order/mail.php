<?php

$this->title = "Письмо";
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Заказ №{$model->order_id}", 'url' => ['view', 'id' => $model->order_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= $model->content ?>

<?php 
//$settings = \Yii::$app->settings;
//
//$settings->set('admin.urlParse', 'https://gitlab.com/prog-positron/test-app-vacancy/-/raw/master/books.json');
//
//$value = $settings->get('admin.urlParse');
//
////$value = $settings->get('key', 'section');
//
//debug($value);
?>
