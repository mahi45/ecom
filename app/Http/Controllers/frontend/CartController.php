<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartPage(){
        $carts = Cart::content();
        // return $carts;
        $total_price = Cart::subtotal();
        return view('frontend.pages.shopping-cart', compact('carts', 'total_price'));
    }

    public function addToCart(Request $request)
    {
        $product_slug = $request->product_slug;
        $order_qty = $request->order_qty;

        $product = Product::whereSlug($product_slug)->first();

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->product_price,
            'qty' => $order_qty,
            'weight' => 0,
            'stock' => $product->product_stock,
            'options' => [
                'product_image' => $product->product_image
            ]
        ]);

        Toastr::success('Product added to cart successfully');
        return redirect()->back();
    }

    public function removeFromCart($cart_id){
        Cart::remove($cart_id);
        Toastr::info('Product removed from cart');
        return back();
    }
}
