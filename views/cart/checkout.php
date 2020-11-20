<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Оформление заказа</h4>
        <div class="site-pagination">
            <a href="<?= \yii\helpers\Url::home() ?>">Главная</a> /
            <a href="<?= \yii\helpers\Url::to(['cart/view']) ?>">Корзина</a> /
            <span>Оформление заказа</span>
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- checkout section  -->
<section class="checkout-section spad">
    <div class="container">
        <?php if(Yii::$app->session->hasFlash('success')):?>
        <div class="alert-success alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo \Yii::$app->session->getFlash('success'); ?>
        </div>
        <?php endif; ?>
        <div class="row">
            <?php if(!empty($session['cart'])): ?>
            <div class="col-lg-8 order-2 order-lg-1">
                <?php $form = \yii\widgets\ActiveForm::begin([
                        'options' => [
                            'class' => 'checkout-form'
                        ]
                    ]); ?>
                    <div class="cf-title">Данные заказчика</div>
                    <?= $form->field($order, 'email')->textInput()->input('text', ['placeholder' => "Введите ваш e-mail"]) ?>
                    <?= $form->field($order, 'name')->textInput()->input('text', ['placeholder' => "Введите ваше имя"]) ?>
                    <?= $form->field($order, 'note')->textarea(['rows' => 5, 'placeholder' => "Введите ваше сообщение"]) ?>
                    <?= $form->field($order, 'phone')->textInput()->input('text', ['placeholder' => "+7 (999) 999 99 99"]) ?>
                    <?= $form->field($order, 'reCaptcha')->widget(
                        \himiklab\yii2\recaptcha\ReCaptcha2::class,
                        [
                            'siteKey' => '6LfKY-QZAAAAAE9uApnCTIxncuQhD2IURvB1ydqR',
                        ]
                    ) ?>
                    <?= yii\helpers\Html::submitButton('Оформить заказ', ['class' => 'site-btn submit-order-btn']) ?>
                <?php \yii\widgets\ActiveForm::end() ?>
            </div>
            <div class="col-lg-4 order-1 order-lg-2">
                <div class="checkout-cart">
                    <h3>Ваша корзина</h3>
                    <ul class="product-list">
                        <?php foreach($session['cart'] as $id => $item): ?>
                            <li>
                                <div class="pl-thumb">
                                    <?= \yii\helpers\Html::img("@web/{$item['img']}", ['alt' => $item['title']]) ?>
                                </div>
                                <h6><?= $item['title'] ?></h6>
                                <p>Количество: <?= $item['qty'] ?></p>
                            </li>
                        <?php endforeach; ?> 
                    </ul>
                    <ul class="price-list">
                        <li class="total">Всего книг<span><?= $session['cart.qty'] ?></span></li>
                    </ul>
                </div>
            </div>
            <?php else: ?>
                <div class="col-md-12">
                    <h3>Корзина пуста...</h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- checkout section end -->
