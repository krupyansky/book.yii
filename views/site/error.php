<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<section class="category-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 order-2 order-lg-1">
                <div class="filter-widget">
                        <h2 class="fw-title">Категории</h2>
                        <ul class="category-menu">
                                <li><a href="#">Женщинам</a>
                                        <ul class="sub-menu">
                                                <li><a href="#">Платья Миди<span>(2)</span></a></li>
                                                <li><a href="#">Платья Макси<span>(56)</span></a></li>
                                                <li><a href="#">Выпускные Платья<span>(36)</span></a></li>
                                                <li><a href="#">Маленькие Черные Платья<span>(27)</span></a></li>
                                                <li><a href="#">Мини-платья<span>(19)</span></a></li>
                                        </ul>
                                </li>
                                <li><a href="#">Мужчинам</a>
                                        <ul class="sub-menu">
                                                <li><a href="#">Платья Миди<span>(2)</span></a></li>
                                                <li><a href="#">Платья Макси<span>(56)</span></a></li>
                                                <li><a href="#">Выпускные Платья<span>(36)</span></a></li>
                                        </ul></li>
                                <li><a href="#">Детям</a></li>
                                <li><a href="#">Сумки и Кошельки</a></li>
                                <li><a href="#">Очки</a></li>
                                <li><a href="#">Обувь</a></li>
                        </ul>
                </div>
            </div>

            <div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
                <h2><?= Html::encode($this->title) ?></h2>
                <div class="alert alert-danger mt-4">
                    <?= nl2br(Html::encode($message)) ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<div class="site-error">

    <h1><?//= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?//= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>-->
