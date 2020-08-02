<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::any('pay', 'OrderController@review')->name('review');
Route::get('success', 'OrderController@success')->name('success');
Route::get('link', function () {
    Artisan::call('storage:link');
});

Route::get('user/invoice/{invoice}', function (Request $request, $invoiceId) {
    return $request->user()->downloadInvoice($invoiceId, [
        'vendor' => 'Your Company',
        'product' => 'Your Product',
    ]);
});

Route::post(
    'stripe/webhook',
    'PaymentController@handleWebhook'
);

Route::resources([
    'pages'      => 'PageController',
    'start'      => 'CategoryController',
    'categories' => 'CategoryController',
    'products'   => 'ProductController',
    'orders'     => 'OrderController',
    'payments'   => 'PaymentController',
]);

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'Admin\AdminController@index')->name('dashboard');
    Route::get('profile/edit/{id?}', 'Admin\UserController@edit')->name('profile.edit');
    Route::get('profile/{id?}', 'Admin\UserController@show')->name('profile');

    Route::resources([
        'menus'         => 'Admin\MenuController',
        'users'         => 'Admin\UserController',
        'customers'     => 'Admin\CustomerController',
        'pages'         => 'Admin\PageController',
        'categories'    => 'Admin\CategoryController',
        'products'      => 'Admin\ProductController',
        'features'      => 'Admin\FeatureController',
        'brands'        => 'Admin\BrandController',
        'orders'        => 'Admin\OrderController',
        'payments'      => 'Admin\PaymentController',
        'settings'      => 'Admin\SettingController',
    ]);
});

Route::get('{slug}', function ($slug) {
    $page = App\Models\Page::whereSlug($slug)->first();
    if ($page) {
        return (new PageController)->show($slug);
    } else {
        if (view()->exists($slug)) {
            return view($slug)->with('title', ucwords($slug));
        } else {
            abort(404);
        }
    }
});
