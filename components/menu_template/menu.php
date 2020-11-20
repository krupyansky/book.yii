<li>
    <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $category['id']]) ?>">
        <?= $category['title'] ?>
        <?php if ($category['title'] == 'Новинки') echo "<span class='new'>New</span>" ?>
    </a>
    <?php if(isset($category['children'])): ?>
        <ul class="sub-menu">
            <?= $this->getMenuHtml($category['children']) ?>
        </ul>
    <?php endif; ?>
</li>
