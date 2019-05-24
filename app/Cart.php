<?php
namespace App;

use Illuminate\Support\Facades\Session;

class Cart
{
    public $totalQty = 0;
    public $totalPrice = 0;
    public $items = null;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->items = $oldCart->items;
        }
    }

    public function add($product_id){
        $product = Product::find($product_id);
        $storeNewItem = ['qty' => 0, 'price' => $product->price, 'product'=> $product];

        if ($this->items){
            if (array_key_exists($product_id, $this->items)){
                $storeNewItem = $this->items[$product_id];
            }
        }
        $storeNewItem['qty']++;
        $storeNewItem['price'] = $storeNewItem['qty'] * $product->price;

        $this->items[$product_id] = $storeNewItem;
        $this->totalQty ++;
        $this->totalPrice += $product->price;
    }

    public function destroy($product_id){

    }

    public function update($newQty, $productId){
        $product = Product::find($productId);
        $oldCart = Session::get('cart');
        $oldItem = $oldCart->items[$productId];
        $itemUpdate = $this->items[$productId];
        $itemUpdate['qty'] = $newQty;
        $itemUpdate['price'] = $newQty * $product->price;

        $this->items[$productId] = $itemUpdate;
        $this->totalPrice = $this->totalPrice - $oldItem['price'] + $itemUpdate['price'];
        $this->totalQty = $this->totalQty - $oldItem['qty'] + $itemUpdate['qty'];
    }
}