<?php

namespace App\Http\Controllers\frontend;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
//Use Cart;

class CartController extends Controller
{
    public function cartPage(){
        $carts = Cart::content();
        // return $carts;
        $total_price = Cart::priceTotal();
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

    public function couponApply(Request $request){
        if(!Auth::check()){
            Toastr::error('You must need to login first');
            return redirect()->route('login.page');
        }

        // validity check
        $check = Coupon::where('coupon_name', $request->coupon_name)->first();
        //dd($check);
        if(Session::get('coupon')){
            Toastr::error('Coupon Already Applied', 'Info!!');
            return redirect()->back();
        }

        if($check != null){
            $check_validity = $check->validity_till > Carbon::now()->format('Y-m-d');
                if($check_validity){
                    Session::put('coupon', [
                        'name' => $check->coupon_name,
                        'discount_amount' => round((Cart::subtotalFloat() * $check->discount_amount)/100),
                        'cart_total' => Cart::subtotalFloat(),
                        'balance' => round(Cart::subtotalFloat() - (Cart::subtotalFloat() * $check->discount_amount)/100)
                    ]);
                    Toastr::success('Coupon Percentage Applied!!', 'Successfully!!');
                    return redirect()->back();
                }else{
                    Toastr::error('Coupon Date Expired!!!', 'Info!!!');
                    return redirect()->back();
                }
        }else{
            Toastr::error('Invalid Action/Coupon! Check, Empty Cart');
            return redirect()->back();
        }
    }

    public function couponRemove($coupon_name)
    {
        Session::forget('coupon');
        Toastr::success('Coupon Removed', 'Successfully!!');
        return redirect()->back();
    }
}
