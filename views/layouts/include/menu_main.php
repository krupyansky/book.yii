<nav class="main-navbar">
    <div class="container">
        <!-- menu -->
        <ul class="main-menu">
            <li><a href="<?= \yii\helpers\Url::home() ?>">Главная</a></li>
            <?= \app\components\MenuWidget::widget([
                'template' => 'menu',
                'level'    => 1,
            ]) ?>
        </ul>
    </div>
</nav>
