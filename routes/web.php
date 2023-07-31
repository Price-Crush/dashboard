<?php

use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\BusinessSectorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EducationalStatusController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MerchantStoreController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MerchantOfferController;
use App\Http\Controllers\MerchantNotificationController;
use App\Http\Controllers\StoreReportsController;
use App\Http\Controllers\BannerOrderController;
use App\Http\Controllers\MerchantNotificationOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WeekDayController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Models\MerchantStore;

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
Route::redirect('/', '/admin-panel/login');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::prefix('admin-panel')->middleware(['auth', 'web'])->group(function () {

    Route::get('countries/{id}/states', function ($id) {
        return response()->json([
            'states' => App\Models\Country::find($id)->states->pluck('name_en', 'id'),
        ]);
    });
    
    Route::get('states/{id}/cities', function ($id) {
        return response()->json([
            'cities' => App\Models\State::find($id)->cities->pluck('name_en', 'id'),
        ]);
    });

    Route::get('/edit_profile', [ProfileController::class, 'edit_profile']);
    Route::post('/update_profile', [ProfileController::class, 'update_profile']);
    Route::post('/update_password', [ProfileController::class, 'update_password']);

    Route::get('/all_internal_notifications', [HomeController::class, 'all_internal_notifications']);


    // Route::get('/higher_management', [UserController::class, 'index']);
    // Route::post('/higher_management', [UserController::class, 'store']);
    // Route::get('/higher_management/{id}/edit', [UserController::class, 'edit']);
    // Route::patch('/higher_management/{id}', [UserController::class, 'update']);
    // Route::delete('/higher_management/{id}', [UserController::class, 'destroy']);


    // Route::get('/executive_management', [UserController::class, 'executive_management_index']);
    // Route::post('/executive_management', [UserController::class, 'executive_management_store']);
    // Route::get('/executive_management/{id}', [UserController::class, 'executive_management_show']);
    // Route::patch('/executive_management/{id}', [UserController::class, 'executive_management_update']);
    // Route::delete('/executive_management/{id}', [UserController::class, 'executive_management_destroy']);

    // Route::get('/users/status/{user_id}/{id}', [UserController::class, 'change_status']);



    // Route::resource('/users', UserController::class);
    Route::resource('/app_settings', AppSettingController::class);
    Route::resource('/countries', CountryController::class);
    Route::resource('/states', StateController::class);
    Route::resource('/cities', CityController::class);
    // Route::resource('/languages', AppSettingController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/user_types', UserTypeController::class);
    Route::resource('/languages', LanguageController::class);
    Route::resource('/currencies', CurrencyController::class);
    Route::resource('/promotions', PromotionController::class);
    Route::resource('/business_sectors', BusinessSectorController::class);
    Route::resource('/education_statuses', EducationalStatusController::class);
    Route::resource('/stores', MerchantStoreController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/merchants', MerchantController::class);
    Route::resource('/offers', MerchantOfferController::class);
    Route::resource('/notifications', MerchantNotificationController::class);
    Route::resource('/banner-orders', BannerOrderController::class);
    Route::resource('/notification-orders', MerchantNotificationOrderController::class);
    Route::resource('/days-work', WeekDayController::class);

    Route::resource('/roles/permissions', PermissionController::class);
    Route::post('/roles/{role}/give-permission/', [RoleController::class,'givePermission']);
    Route::post('/roles/{role}/revoke-permission/', [RoleController::class,'revokePermission']);
    Route::resource('/roles', RoleController::class);
    // Route::get('/roles/permissions/{role_id}', [PermissionController::class , 'index']);


    Route::get('/banner-orders/approve/{order_id}/{status_id}', [BannerOrderController::class , 'approve_order']);
    Route::patch('/banner-orders/reject/{order_id}', [BannerOrderController::class, 'reject_order']);

    Route::get('/notification-orders/approve/{order_id}/{status_id}', [MerchantNotificationOrderController::class , 'approve_order']);
    Route::patch('/notification-orders/reject/{order_id}', [MerchantNotificationOrderController::class, 'reject_order']);

    Route::post('users/{id}/update-role', [UserController::class,'updateRole']);
    Route::post('users/{id}/give-permission', [UserController::class,'givePermission']);
    Route::post('users/{id}/revoke-permission', [UserController::class,'revokePermission']);
    Route::post('users/{id}/add-area', [UserController::class,'addArea']);
    Route::post('users/{id}/remove-area', [UserController::class,'removeArea']);
    Route::resource('users', UserController::class);

    // Route::post('/executive_management/store_city', [UserController::class, 'store_city']);
    // Route::delete('/executive_management/delete_city/{id}', [UserController::class, 'delete_city']);

    // Route::post('/executive_management/store_state', [UserController::class, 'store_state']);
    // Route::delete('/executive_management/delete_state/{id}', [UserController::class, 'delete_state']);

    // Route::post('/executive_management/store_country', [UserController::class, 'store_country']);
    // Route::delete('/executive_management/delete_country/{id}', [UserController::class, 'delete_country']);

    Route::get('/merchants/status/{merchant_id}/{id}', [MerchantController::class, 'change_status']);
    Route::patch('/merchants/block_merchant/{merchant_id}', [MerchantController::class, 'block_merchant']);
    Route::patch('/merchants/alert_merchant/{merchant_id}', [MerchantController::class, 'alert_merchant']);

    Route::patch('/stores/status/{id}', [MerchantStoreController::class, 'change_status']);
    Route::patch('/offers/status/{id}', [MerchantOfferController::class, 'change_status']);
    Route::get('/rate/status/{customer_id}/{id}', [MerchantStoreController::class, 'rate_change_status']);

    Route::get('/stores-reports', [StoreReportsController::class, 'stores_reports']);



    Route::get('/products/status/{product_id}/{status_id}', [ProductController::class, 'change_status']);
    Route::get('/products/image/status/{image_id}/{status_id}', [ProductController::class, 'change_status_image']);
    Route::get('/products/status/{image_id}/{status_id}', [ProductController::class, 'change_status']);

    // start customers routes
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/anonymous', [CustomerController::class, 'anonymous']);
    Route::get('/customers/{id}', [CustomerController::class, 'show']);
    Route::get('/customers/status/{customer_id}/{id}', [CustomerController::class, 'change_status']);
    Route::patch('/customers/block_customer/{customer_id}', [CustomerController::class, 'block_customer']);
    Route::patch('/customers/alert_customer/{customer_id}', [CustomerController::class, 'alert_customer']);
    Route::get('/annonymous', [CustomerController::class, 'get_annonymous']);
    // end customers routes






    // Route::get('/app_settings',[AppSettingController::class,'index']);
    // Route::post('/app_settings',[AppSettingController::class,'store']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/make_rate', function () {
        $stores = MerchantStore::all();
        foreach ($stores as $store) {
            $update_stores = MerchantStore::find($store->id);
            if ($store->store_rates->count() == 0) {
                $update_stores->rate = 0;
            } else {
                $update_stores->rate = $store->store_rates->sum('rating') / $store->store_rates->count();
            }
            $update_stores->update();
        }

        return 1;
    });

});
require __DIR__ . '/auth.php';
