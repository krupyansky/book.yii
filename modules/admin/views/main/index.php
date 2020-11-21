<?php 

$this->title = 'Статистика магазина';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-lg-2 col-xs-6">
    <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $books ?></h3>
              <p>Продуктов</p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="<?= \yii\helpers\Url::to(['book/index']) ?>" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-2 col-xs-6">
    <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $orders ?></h3>

              <p>Заказов</p>
            </div>
            <div class="icon">
                <i class="fa fa-refresh"></i>
            </div>
            <a href="<?= \yii\helpers\Url::to(['order/index']) ?>" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-2 col-xs-6">
    <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $categories ?></h3>

              <p>Категорий</p>
            </div>
            <div class="icon">
                <i class="fa fa-bars"></i>
            </div>
            <a href="<?= \yii\helpers\Url::to(['category/index']) ?>" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
