<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $carts = Session::get('cart');
        return view('carts.list', compact('carts'));
    }

    public function add($productId)
    {
        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
        } else {
            $oldCart = null;
        }

        $cart = new Cart($oldCart);
        $cart->add($productId);
        Session::put('cart', $cart);
        Session::flash('success', 'Add item complete');
        return redirect()->route('products.list');
    }

    public function destroy($productId)
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');

            if (array_key_exists($productId, $cart->items)) {
                $itemDelete = $cart->items[$productId];
                $cart->totalPrice = $cart->totalPrice - $itemDelete['price'];
                $cart->totalQty = $cart->totalQty - $itemDelete['qty'];

                $itemsIntoCart = $cart->items;
                unset($itemsIntoCart[$productId]);

                $cart->items = $itemsIntoCart;

                Session::put('cart', $cart);
            }
        }
        if ($cart->totalQty == 0) {
            Session::forget('cart');
        }
        Session::flash('success', 'Destroy item complete');
        return redirect()->back();
    }

    public function update(Request $request, $productId)
    {
        $newQty = $request->quantity;
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->update($newQty, $productId);
        Session::put('cart', $cart);
        Session::put('Success', 'update to complete');
        return redirect()->route('cart.index');
    }
}
