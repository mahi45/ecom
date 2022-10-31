<?php

namespace App\Http\Controllers\backend;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard(){
        $total_earning = Order::sum('total');
        $total_order = Order::count();
        $total_category = Category::count();
        $total_product = Product::count();
        $total_customer = User::where('role_id', 2)->count();
        $orders = Order::with(['billing', 'orderdetails'])->latest('id')->paginate(15);

        $orders_2020 = Order::whereBetween('created_at', ['2020-01-01', '2020-12-31'])->count();
        $orders_2021 = Order::whereBetween('created_at', ['2021-01-01', '2021-12-31'])->count();
        $orders_2022 = Order::whereBetween('created_at', ['2022-01-01', '2022-12-31'])->count();

        $orders_yearwise = [$orders_2020, $orders_2021, $orders_2022];

        return view('backend.pages.dashboard', compact(
            'total_earning', 'total_order', 'total_category', 'total_product', 'total_customer', 'orders', 'orders_yearwise'
        ));
    }
}
