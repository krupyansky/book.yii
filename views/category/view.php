<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4><?= $category->title ?></h4>
        <div class="site-pagination">
            <a href="<?= \yii\helpers\Url::home() ?>">Главная</a> /
            <?php foreach($breadcrumbs as $breadcrumb): ?>
            <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $breadcrumb->id]) ?>"><?= $breadcrumb->title ?></a> /
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- Category section -->
<section class="category-section spad">
    <div class="container">
        <div class="row">
            <?php if(!empty($products)): ?>
            <div class="col-lg-3 order-2 order-lg-1">
                <?php if(!empty($subcategories)): ?>
                <div class="filter-widget">
                    <h2 class="fw-title">Подкатегории</h2>
                    <ul class="category-menu">
                        <?php foreach($subcategories as $subcategory): ?>
                        <li>
                            <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $subcategory['id']]) ?>">
                                <?= $subcategory['title'] ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <div class="filter-widget mb-0">
                    <h2 class="fw-title">фильтровать по</h2>
                </div>
                <div class="filter-widget mb-0">
                    <h4 class="fw-title">названию</h4>
                    <form class="header-search-form" action="<?= yii\helpers\Url::to(['category/view', 'id' => $category->id]) ?>" method="get">
                        <input type="text" name="title_book" placeholder="Evgeniy Oneg...">
                        <button><i class="flaticon-search"></i></button>
                    </form>
                </div>
                <div class="filter-widget mb-0">
                    <h4 class="fw-title">автору</h4>
                    <form class="header-search-form" action="<?= yii\helpers\Url::to(['category/view', 'id' => $category->id]) ?>" method="get">
                        <input type="text" name="name_author" placeholder="Alex Push...">
                        <button><i class="flaticon-search"></i></button>
                    </form>
                </div>
                <?php if(!empty($options)): ?>
                <div class="filter-widget">
                    <h4 class="fw-title">статусу</h4>
                    <form action="<?= yii\helpers\Url::to(['category/view', 'id' => $category->id]) ?>" method="get">
                        <select name="status_book" class="form-control">
                            <?php foreach($options as $option): ?>
                            <option><?= strtolower($option->status) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button style="width: 100%; margin-top: 15px" class="btn btn-info">ФИЛЬТРОВАТЬ</button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
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
                    <h2>Товар в категории отсутствует...</h2>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- Category section end -->
