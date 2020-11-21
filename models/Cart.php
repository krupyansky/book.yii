<?php

namespace app\models;

use yii\base\Model;

/**
 * Модель, отвечающая за работу корзины
 *
 */
class Cart extends Model
{
    public function addToCart($book, $qty = 1) 
    {
        if ($qty == '-1'){
            $qty = -1;
        } else {
            $qty = 1;
        }
        if (isset($_SESSION['cart'][$book->id])){
            $_SESSION['cart'][$book->id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$book->id] = [
                'title' => $book->title,
                'qty' => $qty,
                'img' => $book->thumbnailUrl,
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        if ($_SESSION['cart'][$book->id]['qty'] == 0){
            unset($_SESSION['cart'][$book->id]);
        }
    }
    
    public function recalc($id)
    {
        if(!isset($_SESSION['cart'][$id])){
            return false;
        }
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $_SESSION['cart.qty'] -= $qtyMinus;
        unset($_SESSION['cart'][$id]);
    } 
}
