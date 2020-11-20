<!-- letest product section -->
<?php if(!empty($last_books)): ?>
<section class="top-letest-product-section">
    <div class="container">
        <div class="section-title">
            <h2>ПОСЛЕДНИЕ КНИГИ</h2>
        </div>
        <div class="product-slider owl-carousel">
            <?php foreach ($last_books as $last_book): ?>
            <div class="product-item">
                <div class="pi-pic">
                    <?= \yii\helpers\Html::img("@web/{$last_book->thumbnailUrl}", ['alt' => $last_book->title]) ?>
                    <div class="pi-links">
                        <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $last_book->id]) ?>" class="add-card">
                            <i class="flaticon-bag"></i>
                            <span>В КОРЗИНУ</span>
                        </a>
                    </div>
                </div>
                <div class="pi-text">
                    <p><?= $last_book->title ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- letest product section end -->
