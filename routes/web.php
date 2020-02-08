<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use RealRashid\SweetAlert\Facades\Alert;
use App\Menu;
use App\Order;
use App\OrderDetail;
use App\User;
use Symfony\Component\HttpFoundation\Request;

Route::get('/', function () {
    return redirect(route('auth.login'));
});

// Auth Route 
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', function () {
        return view('auth._login');
    })->name('auth.login');

    Route::get('register', function () {
        return view('auth._register');
    })->name('auth.register');

    Route::get('logout', function () {
        Alert::info('Thanks', 'See You Next Time!');
        return redirect(route('auth.login'));
    })->name('auth.logout');

    Route::post('register', 'AuthController@register')->name('auth.register.action');
    Route::post('login', 'AuthController@login')->name('auth.login.action');
});

// Admin Route
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');

    Route::get('menu', function () {
        $menus = Menu::get();
        return view('admin._menu', compact('menus'));
    })->name('admin.menus');

    Route::post('menu', 'MenuController@add_menu')->name('admin.add_menu');

    Route::get('menu/update/{id}', function ($id) {
        $menu = Menu::findOrFail($id);
        return view('admin._menu_update', compact('menu'));
    })->name('admin.update_menu');

    Route::put('menu/update/{id}', 'MenuController@update_menu')->name('admin.update_menu');

    Route::get('menu/delete/{id}', 'MenuController@delete_menu')->name('admin.delete_menu');

    Route::get('user/update/{id}', function ($id) {
        $user = User::findOrFail($id);
        return view('auth._user_update', compact('user'));
    })->name('auth.user_update');

    Route::put('user/update/{id}', 'AuthController@user_update')->name('auth.user_update');

    Route::get('transaction', function () {
        $orders = Order::all();
        return view('admin._transaction', compact('orders'));
    })->name('admin.transaction');

    Route::get('report-payment/{id}', function ($id) {
        $order = Order::findOrFail($id);
        $orderDetails = OrderDetail::whereOrderId($order->id)->get();
        $data = [
            'order' => $order,
            'orderDetails' => $orderDetails
        ];
        $pdf = PDF::loadView('admin._report_payment', $data)->setPaper('a6', 'potrait');
        return $pdf->stream();
    })->name('admin.report_payment');
});

// Customers Route
Route::group(['prefix' => 'customers'], function () {
    Route::get('/', function () {
        $menus = Menu::get();
        return view('customers._purchase', compact('menus'));
    })->name('customers.purchase');

    Route::get('menu/{id}', function ($id) {
        $menu = Menu::findOrFail($id);
        return view('customers._menu_detail', compact('menu'));
    })->name('customers.menu_detail');

    Route::get('menu/order/{id}', function ($id) {
        $menu = Menu::findOrFail($id);
        return view('customers._menu_order', compact('menu'));
    })->name('customers.order');

    Route::post('menu/order/{id}', 'OrderController@order')->name('customers.order_action');

    Route::get('check-out', 'OrderController@checkOut')->name('customers.check_out');

    Route::delete('check-out/delete/{id}', 'OrderController@checkOutMenuDelete')->name('customers.check_out_delete');

    Route::get('check-out/update/{id}', function ($id) {
        $orderMenuUpdate = OrderDetail::findOrFail($id);
        return view('customers._check_out_update', compact('orderMenuUpdate'));
    })->name('customers.check_out_update');

    Route::put('check-out/update/{id}', 'OrderController@checkOutMenuUpdate')->name('customers.check_out_update_action');

    Route::post('order-confirm', 'OrderController@orderConfirm')->name('customers.order_confirm');

    Route::post('order-cancel', 'OrderController@orderCancel')->name('customers.order_cancel');
});
