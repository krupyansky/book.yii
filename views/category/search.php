<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Поиск: "<?= $search ?>"</h4>
        <div class="site-pagination">
            <a href="<?= \yii\helpers\Url::home() ?>">Главная</a> /
            <span>Поиск</span>
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- Category section -->
<section class="category-section spad">
    <div class="container">
        <div class="row">
            <?php if(!empty($products)): ?>
                <div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
                    <div class="row">
                        <?php foreach($products as $product): ?>  
                        <div class="col-lg-3 col-sm-4">
                            <div class="product-item product-item-category">
                                <div class="pi-pic">
                                    <?= \yii\helpers\Html::img("@web/{$product->thumbnailUrl}", ['alt' => $product->title]) ?>
                                    <div class="pi-links">
                                        <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $product->id]) ?>" class="add-card">
                                            <i class="flaticon-bag"></i>
                                            <span>В КОРЗИНУ</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <p><?= $product->title ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row">
                        <?= \yii\widgets\LinkPager::widget([
                            'pagination' => $pages,
                            'maxButtonCount' => 5,
                        ]) ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center w-100 pt-3">
                    <h2>По запросу ничего не найдено...</h2>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- Category section end -->
