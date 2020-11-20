<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Корзина</h4>
        <div class="site-pagination">
            <a href="<?= \yii\helpers\Url::home() ?>">Главная</a> /
            <span>Корзина</span>
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- cart section end -->
<section class="cart-section spad">
    <div class="container">
        <div class="row">
            <?php if(!empty($session['cart'])): ?>
            <div class="col-lg-8">
                <div class="cart-table">
                    <div class="overlay"></div>
                    <h3>Корзина</h3>
                    <div class="cart-table-warp">    
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-th">Книга</th>
                                    <th class="quy-th">Количество</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($session['cart'] as $id => $item): ?>
                                <tr>
                                    <td class="product-col">
                                        <a href="<?= yii\helpers\Url::to(['product/view', 'id' => $id]) ?>">
                                            <?= \yii\helpers\Html::img("@web/{$item['img']}", ['alt' => $item['title']]) ?>
                                        </a>
                                        <div class="pc-title">
                                            <h4><?= $item['title'] ?></h4>
                                        </div>
                                    </td>
                                    <td class="quy-col">
                                        <div class="quantity">
                                            <div class="pro-qty" data-id="<?= $id ?>">
                                                <input type="text" value="<?= $item['qty'] ?>">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="total-cost">
                            <h6>Всего книг <span><?= $session['cart.qty'] ?></span></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 card-right">
                <a href="<?= yii\helpers\Url::to(['cart/checkout']) ?>" class="site-btn">Перейти к оформлению</a>
                <a href="<?= yii\helpers\Url::home(); ?>" class="site-btn sb-dark">Продолжить покупки</a>
            </div>
            <?php else: ?>
                <h3>Корзина пуста...</h3>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- cart section end -->
