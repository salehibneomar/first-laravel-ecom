<?php

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BannerSliderController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SalesReportController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductCartController;
use App\Http\Controllers\Frontend\ProductCategoryController;
use App\Http\Controllers\Frontend\ProductDetailsController;
use App\Http\Controllers\Frontend\ProductSearchController;
use App\Http\Controllers\Frontend\UserAccountController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('page.landing');

Auth::routes();

Route::prefix('/admin')->name('admin.')->group(function(){
   
    //Admin Login
    Route::middleware('guest:admin')->group(function(){
        Route::get('/', [AdminLoginController::class, 'showLoginForm'])->name('login.page');
        Route::post('/login', [AdminLoginController::class, 'login'])->name('login');
    });

    Route::middleware('auth:admin')->group(function(){
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
        Route::view('/dashboard', 'backend.index')->name('dashboard');

        Route::prefix('/profile')->name('profile.')->group(function(){
            Route::get('/', [AdminProfileController::class, 'index'])->name('show');
            Route::get('/edit', [AdminProfileController::class, 'edit'])->name('edit');
            Route::post('/update-general', [AdminProfileController::class, 'updateGeneral'])->name('update.general');
            Route::post('/update-password', [AdminProfileController::class, 'updatePassword'])->name('update.password');
            Route::post('/update-image', [AdminProfileController::class, 'updateImage'])->name('update.image');
        });

    });

});


Route::middleware('auth:admin')->group(function(){

    Route::prefix('/brand')->name('brand.')->group(function(){
        Route::get('/all', [BrandController::class, 'index'])->name('all');
        Route::get('/add', [BrandController::class, 'create'])->name('add');
        Route::post('/store', [BrandController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [BrandController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [BrandController::class, 'destroy'])->name('delete');
    });
    
    Route::prefix('/category')->name('category.')->group(function(){
        Route::get('/all', [CategoryController::class, 'index'])->name('all');
        Route::get('/add', [CategoryController::class, 'create'])->name('add');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('delete');
    });
    
    Route::prefix('/product')->name('product.')->group(function(){
        Route::get('/all', [ProductController::class, 'index'])->name('all');
        Route::get('/add', [ProductController::class, 'create'])->name('add');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/banner-slider')->name('banner.slider.')->group(function(){
        Route::get('/all', [BannerSliderController::class, 'index'])->name('all');
        Route::get('/add', [BannerSliderController::class, 'create'])->name('add');
        Route::post('/store', [BannerSliderController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BannerSliderController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [BannerSliderController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [BannerSliderController::class, 'destroy'])->name('delete');
    });


    Route::prefix('/shipping')->name('shipping.')->group(function(){
        Route::get('/division', [ShippingController::class, 'viewDivision'])->name('division.view');
        Route::post('/division/add', [ShippingController::class, 'addDivision'])->name('division.add');
        Route::get('/division/delete/{id}', [ShippingController::class, 'deleteDivision'])->name('division.delete');
    });

    Route::prefix('/orders')->name('orders.')->group(function(){
        Route::get('/processing', [OrderController::class, 'processing'])->name('processing');
        Route::get('/pending', [OrderController::class, 'pending'])->name('pending');
        Route::get('/delivered', [OrderController::class, 'delivered'])->name('delivered');
        Route::get('/canceled', [OrderController::class, 'canceled'])->name('canceled');
        Route::get('/confirmed', [OrderController::class, 'confirmed'])->name('confirmed');
        Route::get('/details/{id}', [OrderController::class, 'viewDetails'])->name('details');
        Route::get('/invoice-download/{id}', [OrderController::class, 'invoiceDownload'])->name('invoice');
        Route::post('/change-status/{id}', [OrderController::class, 'changeStatus'])->name('change.status');
        Route::get('/delete/{id}', [OrderController::class, 'destroy'])->name('delete');
        Route::get('confirm/{id}', [OrderController::class, 'confirm'])->name('confirm');
    });

    Route::prefix('/user')->name('user.')->group(function(){
        Route::get('/all', [App\Http\Controllers\Backend\UserController::class, 'index'])->name('all');
        Route::get('/{userId}/orders', [App\Http\Controllers\Backend\UserController::class, 'orders'])->name('orders');
    });

    Route::get('/site-settings', [SiteSettingController::class, 'index'])->name('site.settings.view');
    Route::post('/site-settings/update', [SiteSettingController::class, 'update'])->name('site.settings.update');

    Route::prefix('/sales')->name('sales.')->group(function(){
        Route::get('/trends', [SalesReportController::class, 'trends'])->name('trends');
        Route::get('/', [SalesReportController::class, 'index'])->name('page');
        Route::get('/search', [SalesReportController::class, 'search'])->name('search');
        
    });

});


Route::middleware('auth:web')->group(function(){

    Route::prefix('/account')->name('account.')->group(function(){
        Route::get('/', [UserAccountController::class, 'index'])->name('show');
        Route::get('/edit-profile', [UserAccountController::class, 'editProfile'])->name('edit.profile');
        Route::post('/update-image', [UserAccountController::class, 'updateImage'])->name('update.image');
        Route::post('/update-information', [UserAccountController::class, 'updateInformation'])->name('update.information');
        Route::get('/edit-password', [UserAccountController::class, 'editPassword'])->name('edit.password');
        Route::post('/update-password', [UserAccountController::class, 'updatePassword'])->name('update.password');

        Route::get('/my-orders', [UserOrderController::class, 'viewAllOrders'])->name('orders');
        Route::get('/my-order-items/{orderId}', [UserOrderController::class, 'viewOrderItems'])->name('order.items');
        Route::get('/download-order-invoice/{orderId}', [UserOrderController::class, 'downloadOrderInvoice'])->name('order.invoice');
    });
    
});


Route::prefix('/product')->name('frontend.product.')->group(function(){
    Route::get('/details/{id}/{slug}', [ProductDetailsController::class, 'index'])->name('details');

    Route::get('/category/{id}/{slug}', [ProductCategoryController::class, 'index'])->name('category');

    Route::prefix('/cart')->name('cart.')->group(function(){
        Route::get('/add/{id}/{slug}', [ProductCartController::class, 'addOnTheFly'])->name('add.fly');
        Route::post('/add/{id}', [ProductCartController::class, 'addFromDetailsPage'])->name('add');
        Route::get('/delete/{rowId}', [ProductCartController::class, 'removeItem'])->name('remove');
        Route::get('/all', [ProductCartController::class, 'viewAll'])->name('all');
        Route::post('/edit/{rowId}', [ProductCartController::class, 'update'])->name('update');
    });

    Route::get('/checkout/cash-on-delivery', [CheckOutController::class, 'index'])->name('checkout.cod');
    Route::post('/order/store', [CheckOutController::class, 'storeOrder'])->name('order.store');

    Route::get('/checkout/online', [SslCommerzPaymentController::class, 'hostedCheckout'])->name('checkout.online');

    Route::get('/search',  [ProductSearchController::class, 'index'])->name('search');
    
});


// SSLCOMMERZ Start


Route::middleware('auth:web')->group(function(){
    Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
});


