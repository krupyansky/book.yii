<option 
    value="<?= $category['id'] ?>" 
    <?php if($category['id'] == $this->model->parentID) echo ' selected' ?>
    <?php if($category['id'] == $this->model->id || $child) echo ' disabled' ?>
>
    <?= "{$tab} {$category['title']}" ?>
</option>
<?php if(isset($category['children']) && $category['id'] == $this->model->id): ?>
    <?= $this->getMenuHtml($category['children'], $tab .= '-', $category) ?>
<?php elseif(isset($category['children'])): ?>
    <?= $this->getMenuHtml($category['children'], $tab .= '-') ?>
<?php endif; ?>
