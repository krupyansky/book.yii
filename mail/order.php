<div class="table-responsive">
    <table style="width: 100%; border: 1px solid #000; border-collapse: collapse; border-radius: 5px">
        <thead>
        <tr style="background: #282828;">
            <th style="padding: 10px; border: 1px solid #000; color: #fff;">Наименование</th>
            <th style="padding: 10px; border: 1px solid #000; color: #fff;">Кол-во</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($session['cart'] as $id => $item): ?>
            <tr>
                <td style="padding: 10px; border: 1px solid #000;"><?= $item['title'] ?></td>
                <td style="padding: 10px; border: 1px solid #000;"><?= $item['qty'] ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td style="padding: 10px; border: 1px solid #000;">Всего книг: </td>
            <td style="padding: 10px; border: 1px solid #000;"><?= $session['cart.qty'] ?></td>
        </tr>
        </tbody>
    </table>
</div>
