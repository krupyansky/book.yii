<?php if(!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($session['cart'] as $id => $item):?>
                <tr>
                    <td><?= \yii\helpers\Html::img("@web/{$item['img']}", ['alt' => $item['title']]) ?></td>
                    <td><?= $item['title']?></td>
                    <td><?= $item['qty']?></td>
                    <td>
                        <svg data-id="<?= $id?>" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x text-danger del-item" style="cursor: pointer" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </td>
                </tr>
            <?php endforeach?>
            <tr>
                <td colspan="4">Всего книг: </td>
                <td id="cart-qty"><?= $session['cart.qty']?></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <h3>Корзина пуста</h3>
<?php endif;?>