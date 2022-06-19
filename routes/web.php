<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponCodesController;
use App\Http\Controllers\InstallmentsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserAddressesController;
use Illuminate\Support\Facades\Route;

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


//Route::get('/', [PagesController::class, 'root']);

Auth::routes(['verify'=>true]);


// auth 中间件代表需要登录，verified中间件代表需要经过邮箱验证
Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('user_addresses', [UserAddressesController::class,'index'])->name('user_addresses.index');
    Route::get('user_addresses/create',  [UserAddressesController::class,'create'])->name('user_addresses.create');
    Route::post('user_addresses/store',  [UserAddressesController::class,'store'])->name('user_addresses.store');
    Route::get('user_addresses/{user_address}',  [UserAddressesController::class,'edit'])->name('user_addresses.edit');
    Route::put('user_addresses/{user_address}',  [UserAddressesController::class,'update'])->name('user_addresses.update');
    Route::delete('user_addresses/{user_address}',  [UserAddressesController::class,'destroy'])->name('user_addresses.destroy');




    Route::post('products/{product}/favorite',[ProductsController::class,'favor'])->name('products.favor');
    Route::delete('products/{product}/favorite', [ProductsController::class,'disfavor'])->name('products.disfavor');
    Route::get('products/favorites', [ProductsController::class,'favorites'])->name('products.favorites');


    Route::post('cart', [CartController::class,'add'])->name('cart.add');
    Route::get('cart', [CartController::class,'index'])->name('cart.index');
    Route::delete('cart/{sku}', [CartController::class,'remove'])->name('cart.remove');


    Route::post('orders', [OrdersController::class,'store'])->name('orders.store');
    Route::get('orders', [OrdersController::class,'index'])->name('orders.index');
    Route::get('orders/{order}', [OrdersController::class,'show'])->name('orders.show');
    Route::post('orders/{order}/received', [OrdersController::class,'received'])->name('orders.received');
    Route::get('orders/{order}/review', [OrdersController::class,'review'])->name('orders.review.show');
    Route::post('orders/{order}/review', [OrdersController::class,'sendReview'])->name('orders.review.store');
    Route::post('orders/{order}/apply_refund', [OrdersController::class,'applyRefund'])->name('orders.apply_refund');

    Route::post('crowdfunding_orders', [OrdersController::class,'crowdfunding'])->name('crowdfunding_orders.store');



    Route::get('payment/{order}/alipay', [PaymentController::class,'payByAlipay'])->name('payment.alipay');
    Route::get('payment/{order}/wechat', [PaymentController::class,'payByWechat'])->name('payment.wechat');
    Route::get('payment/alipay/return', [PaymentController::class,'alipayReturn'])->name('payment.alipay.return');
    Route::post('payment/{order}/installment', [PaymentController::class,'payByInstallment'])->name('payment.installment');


    Route::get('coupon_codes/{code}', [CouponCodesController::class,'show'])->name('coupon_codes.show');


    Route::get('installments', [InstallmentsController::class,'index'])->name('installments.index');
    Route::get('installments/{installment}', [InstallmentsController::class,'show'])->name('installments.show');
    Route::get('installments/{installment}/alipay', [InstallmentsController::class,'payByAlipay'])->name('installments.alipay');
    Route::get('installments/alipay/return', [InstallmentsController::class,'alipayReturn'])->name('installments.alipay.return');
    Route::get('installments/{installment}/wechat', [InstallmentsController::class,'payByWechat'])->name('installments.wechat');
    Route::post('installments/wechat/refund_notify', [InstallmentsController::class,'wechatRefundNotify'])->name('installments.wechat.refund_notify');




});
Route::redirect('/', '/products')->name('root');
Route::get('products', [ProductsController::class,'index'])->name('products.index');
Route::get('products/{product}', [ProductsController::class,'show'])->name('products.show');
Route::post('payment/alipay/notify', [PaymentController::class,'alipayNotify'])->name('payment.alipay.notify');
Route::post('payment/wechat/notify', [PaymentController::class,'wechatNotify'])->name('payment.wechat.notify');
Route::post('payment/wechat/refund_notify', [PaymentController::class,'wechatRefundNotify'])->name('payment.wechat.refund_notify');
Route::post('installments/alipay/notify', [InstallmentsController::class,'alipayNotify'])->name('installments.alipay.notify');
Route::post('installments/wechat/notify', [InstallmentsController::class,'wechatNotify'])->name('installments.wechat.notify');


