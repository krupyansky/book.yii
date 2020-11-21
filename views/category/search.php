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
            <?php if(!empty($books)): ?>
                <div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
                    <div class="row">
                        <?php foreach($books as $book): ?>  
                        <div class="col-lg-3 col-sm-4">
                            <div class="product-item product-item-category">
                                <div class="pi-pic">
                                    <?= \yii\helpers\Html::img("@web/{$book->thumbnailUrl}", ['alt' => $book->title]) ?>
                                    <div class="pi-links">
                                        <a href="<?= \yii\helpers\Url::to(['book/view', 'id' => $book->id]) ?>" class="add-card">
                                            <i class="flaticon-bag"></i>
                                            <span>В КОРЗИНУ</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <p><?= $book->title ?></p>
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
