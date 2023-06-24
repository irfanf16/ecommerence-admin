<?php


use App\Http\Controllers\Admin\AdminStockManagementContoller;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// AUTH CONTROLLER
use App\Http\Controllers\AuthController;

// AJAX CONTROLLER
use App\Http\Controllers\Admin\AdminAjaxRequestsController;
use App\Http\Controllers\Admin\AdminAppSettingController;

// ADMIN CONTROLLERS
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminSubcategoriesController;
use App\Http\Controllers\Admin\AdminChildcategoriesController;
use App\Http\Controllers\Admin\AdminCitiesController;
use App\Http\Controllers\Admin\AdminMobileCoversController;
use App\Http\Controllers\Admin\AdminPartnerController;
use App\Http\Controllers\Admin\AdminProfileController;

use App\Http\Controllers\Admin\AdminVendorsController;
use App\Http\Controllers\Admin\AdminVendorStoresController;
use App\Http\Controllers\Admin\AdminBuyersController;

use App\Http\Controllers\Admin\AdminProductsController;
use App\Http\Controllers\Admin\AdminProductVariantsController;
use App\Http\Controllers\Admin\AdminProductQuestionsController;
use App\Http\Controllers\Admin\AdminProductReviewsController;

use App\Http\Controllers\Admin\AdminBrandsController;
use App\Http\Controllers\Admin\AdminAttributesController;
use App\Http\Controllers\Admin\AdminCustomerStoresController;
use App\Http\Controllers\Admin\AdminVariantsController;

use App\Http\Controllers\Admin\AdminOrdersController;
use App\Http\Controllers\Admin\AdminKeysController;
use App\Http\Controllers\Admin\AdminSocialLinkController;
use App\Http\Controllers\Admin\AdminUserManagementController;
use App\Http\Controllers\Admin\AdminCommissionController;
use App\Http\Controllers\Admin\AdminContactsController;
use App\Http\Controllers\Admin\AdminSubscribersController;

// use App\Http\Controllers\Admin\AdminCustomeStoresController;

// SETTINGS
use App\Http\Controllers\Admin\AdminWebsiteBannersController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\MassUploadController;
use App\Http\Middleware\VerifyUrl;
use Illuminate\Support\Facades\Artisan;

/*
|===========================================================
| FOR TEST DATA INSERTION
|===========================================================

    Route::get('data', function(){
        $categories = \App\Models\SubCategory::with('attributes')->get();
        return $category;

        $subcategory = \App\Models\SubCategory::all();

        $attribute->subcategories()->detach();

        $attribute->subcategories()->attach($subcategory);

    });

*/

Route::get('cache', function () {
    Artisan::call('optimize');
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return back();
});


/*
|========================================================================
| AUTH ROUTES
|========================================================================
*/
Route::middleware([VerifyUrl::class])->group(function () {

    Route::get('/', [AuthController::class, 'loginView']);
    Route::get('/login', [AuthController::class, 'loginView']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerView']);
    Route::post('/register', [AuthController::class, 'register']);

});
Route::get('/logout', [AuthController::class, 'logout']);


/*
|========================================================================
| AJAX ROUTES
|========================================================================
*/
Route::group(['prefix' => '/admin/ajax/', 'middleware' => []],
    function () {

        Route::get('categories', [AdminAjaxRequestsController::class, 'categoriesList']);
        Route::get('subcategories', [AdminAjaxRequestsController::class, 'subcategoriesList']);
        Route::get('childcategories', [AdminAjaxRequestsController::class, 'childcategoriesList']);
        Route::get('variants', [AdminAjaxRequestsController::class, 'variantsList']);
        Route::get('multiple-subcategories', [AdminAjaxRequestsController::class, 'multipleSubCategories']);
        Route::get('multiple-childcategories', [AdminAjaxRequestsController::class, 'multipleChildCategories']);
    });


/*
|========================================================================
| STORAK-ADMIN ROUTES
|========================================================================
*/
Route::group(['prefix' => 'admin/', 'middleware' => ['isStorakAdmin']],
    function () {

        // DASHBOARD
        Route::get('dashboard', [AdminDashboardController::class, 'index']);

        // CATEGORY
        Route::resource('categories', AdminCategoriesController::class);
        Route::prefix('category')->group(function () {
            Route::get('/archive', [AdminCategoriesController::class, 'showArchive']);
            Route::post('/restore', [AdminCategoriesController::class, 'restoreCategory']);
            Route::post('/order/update', [AdminCategoriesController::class, 'orderUpdate']);
            Route::get('/test', [AdminCategoriesController::class, 'test']);
            Route::get('/change/status', [AdminCategoriesController::class, 'changeStatus']);
        });

        // SUB-CATEGORY
        Route::resource('subcategories', AdminSubcategoriesController::class);
        Route::get('get/subcategories', [AdminSubcategoriesController::class, 'index']);
        Route::prefix('subcategory')->group(function () {
            Route::get('/archive', [AdminSubcategoriesController::class, 'showArchive']);
            Route::post('/restore', [AdminSubcategoriesController::class, 'restoreCategory']);
            Route::post('/order/update', [AdminSubcategoriesController::class, 'orderUpdate']);
            Route::get('/change/status', [AdminSubcategoriesController::class, 'changeStatus']);
        });

        // CHILD-CATEGORY
        Route::resource('childcategories', AdminChildcategoriesController::class);
        Route::get('get/childcategories', [AdminChildcategoriesController::class, 'index']);
        Route::get('child/change/status', [AdminChildcategoriesController::class, 'changeStatus']);
        Route::prefix('childcategory')->group(function () {
            Route::get('/archive', [AdminChildcategoriesController::class, 'showArchive']);
            Route::post('/restore', [AdminChildcategoriesController::class, 'restoreCategory']);
            Route::post('/order/update', [AdminChildcategoriesController::class, 'orderUpdate']);
        });


        Route::resource('cities', AdminCitiesController::class);


        // VENDORS-MANAGEMENT
        Route::group(['prefix' => 'vendor/', 'middleware' => []],
            function () {
                Route::get('profiles', [AdminVendorsController::class, 'allVendors']);
                Route::get('profiles/incomplete', [AdminVendorsController::class, 'incompleteVendors']);
                Route::get('profiles/under-review', [AdminVendorsController::class, 'underReviewVendors']);
                Route::get('profiles/approved', [AdminVendorsController::class, 'approvedVendors']);
                Route::get('profiles/rejected', [AdminVendorsController::class, 'rejectedVendors']);

                // PROFILE DETAILS
                Route::get('profile/incomplete/{id}', [AdminVendorsController::class, 'incompleteVendorDetail']);
                Route::get('profile/detail/{id}', [AdminVendorsController::class, 'vendorProfileDetail']);

                // UPDATE VENDOR STATUS
                Route::post('profile/update-status/{id}', [AdminVendorsController::class, 'updateVendorStatus']);
            });


        // MANAGE STORES
        Route::get('vendor/store/status', [AdminVendorStoresController::class, 'changeStatus']);
        Route::resource('stores/vendor', AdminVendorStoresController::class);
        Route::get('customer/store/status', [AdminCustomerStoresController::class, 'changeStatus']);
        Route::resource('stores/customer', AdminCustomerStoresController::class);
        Route::get('/stores/customer/collections/{id}', [AdminCustomerStoresController::class, 'collections']);
        Route::get('/collection/visibility', [AdminCustomerStoresController::class, 'collectionVisibility']);

    Route::resource('buyers', AdminBuyersController::class);
     // CUSTOMERS LISTING
     Route::get('customer/profiles',[AdminUserManagementController::class, 'allCustomers']);
     Route::get('customer/wishlist',[AdminUserManagementController::class, 'wishlist']);
     Route::get('customer/cartItems',[AdminUserManagementController::class, 'cartItems']);
     Route::get('customer/profile/{id}',[AdminUserManagementController::class, 'customerDetail']);
     Route::get('customer/status', [AdminUserManagementController::class, 'changeStatus']);

        // massupload Products
        Route::prefix('/massupload')->group(function () {
            Route::resource('product', MassUploadController::class);
        });

        // PRODUCTS MANAGEMENT
        Route::resource('products', AdminProductsController::class);

        Route::get('product/change/status', [AdminProductsController::class, 'changeStatus']);
        Route::get('get/products', [AdminProductsController::class, 'index'])->name('product.list');
        Route::get('product/{id}/editTranslation', [AdminProductsController::class, 'editTranslation']);
        Route::put('product/{id}/updateTranslation', [AdminProductsController::class, 'updateTranslation']);

        Route::get('products/{pid}/variants', [AdminProductVariantsController::class, 'index']);
        Route::get('products/{pid}/variants/create', [AdminProductVariantsController::class, 'create']);
        Route::post('products/{pid}/variants', [AdminProductVariantsController::class, 'store']);
        Route::get('products/{pid}/variants/{vid}/edit', [AdminProductVariantsController::class, 'edit']);
        Route::put('products/{pid}/variants/{vid}', [AdminProductVariantsController::class, 'update']);
        Route::delete('products/{pid}/variants/{vid}', [AdminProductVariantsController::class, 'destroy']);
        Route::post('products/{pid}/variants/{vid}/addstock', [AdminProductVariantsController::class, 'addStock']);

//    Stock Managements

        Route::get('product/stocks/list', [AdminStockManagementContoller::class, 'index']);
        Route::get('product/stocks/availability', [AdminStockManagementContoller::class, 'changeStatus']);


        // PRODUCT QUESTIONS
        Route::get('products/{pid}/questions', [AdminProductQuestionsController::class, 'index']);
        Route::get('products/{pid}/questions/{qid}/edit', [AdminProductQuestionsController::class, 'edit']);
        Route::put('products/{pid}/questions/{qid}', [AdminProductQuestionsController::class, 'update']);
        Route::delete('products/{pid}/questions/{qid}', [AdminProductQuestionsController::class, 'destroy']);
        //Questions
        Route::get('questions', [AdminProductQuestionsController::class, 'questionsList']);
        Route::get('/question/status', [AdminProductQuestionsController::class, 'changeStatus']);
        // PRODUCT REVIEWS
        Route::get('products/{pid}/reviews', [AdminProductReviewsController::class, 'index']);
        Route::get('products/{pid}/reviews/{rid}/edit', [AdminProductReviewsController::class, 'edit']);
        Route::put('products/{pid}/reviews/{rid}', [AdminProductReviewsController::class, 'update']);
        Route::delete('products/{pid}/reviews/{rid}', [AdminProductReviewsController::class, 'destroy']);
//    Reviews
        Route::get('reviews', [AdminProductReviewsController::class, 'reviewsList']);
        Route::get('/review/status', [AdminProductReviewsController::class, 'changeStatus']);


        Route::prefix('brands')->group(function () {
            Route::get('/archive', [AdminBrandsController::class, 'showArchive']);
            Route::post('/restore', [AdminBrandsController::class, 'restoreCategory']);
        });

        Route::get('brand/change/status', [AdminBrandsController::class, 'changeStatus']);
        Route::get('get/brands', [AdminBrandsController::class, 'index'])->name('brand.list');
        Route::resource('brands', AdminBrandsController::class);


// attributes
        Route::resource('/attributes', AdminAttributesController::class);
        Route::get('get/attributes', [AdminAttributesController::class, 'index'])->name('attributes.list');
        Route::get('/attribute/change/status', [AdminAttributesController::class, 'changeStatus'])->name('.status');
        // Route::post('attributes/destroy/{id}',[AdminAttributesController::class,'destroy'])->name('attributes.destroy');

        // keys
        Route::resource('keys', AdminKeysController::class);
        Route::get('get/keys', [AdminKeysController::class, 'index'])->name('keys.list');
        Route::get('/key/change/status', [AdminKeysController::class, 'changeStatus'])->name('key.status');
        // Route::post('keys/destroy/{id}',[AdminKeysController::class,'destroy'])->name('keys.destroy');

        // variants
        Route::resource('variants', AdminVariantsController::class);


        // ORDERS MANAGEMENT
        Route::resource('orders', AdminOrdersController::class);
        Route::post('order-status', [AdminOrdersController::class, 'orderStatus']);
        Route::post('order/status/listing', [AdminOrdersController::class, 'orderStatusListing']);
        Route::post('order-status/{id}', [AdminOrdersController::class, 'orderStatusUpdate']);
        Route::get('order-invoice/{id}', [AdminOrdersController::class, 'orderInvoice']);

        // Route::resource('invoices', AdminInvoicesController::class);
        // Route::resource('menus', AdminMenusController::class);
        Route::resource('partners', AdminPartnerController::class);
        Route::resource('siteSettings', SiteSettingsController::class);
        Route::get('app/settings', [AdminAppSettingController::class, 'index'])->name('app.setting');
        Route::get('app/setting/edit/{id}', [AdminAppSettingController::class, 'edit'])->name('app.setting.edit');
        Route::put('app/settings/update/{id}', [AdminAppSettingController::class, 'update'])->name('app.settings.update');
        Route::post('app/settings/status/{id}', [AdminAppSettingController::class, 'changeStatus']);
        Route::delete('app/settings/delete/{id}', [AdminAppSettingController::class, 'destroy'])->name('app.settings.destroy');


//    admin commission module

        Route::prefix('commissions')->group(function () {
            Route::get('/', [AdminCommissionController::class, 'index'])->name('commissions');
            Route::get('/applied', [AdminCommissionController::class, 'appliedCommissionSection'])->name('commissions.applied');
            Route::post('/update', [AdminCommissionController::class, 'updateCommissions'])->name('commissions.update');
        });


        // WEBSITE BANNERS
        Route::prefix('website/banners')->group(function () {
            Route::get('/archive', [AdminWebsiteBannersController::class, 'showArchive']);
            Route::post('/restore', [AdminWebsiteBannersController::class, 'restoreCategory']);
            Route::post('/order/update', [AdminWebsiteBannersController::class, 'orderUpdate']);
        });
        Route::resource('website/banners', AdminWebsiteBannersController::class);

        Route::resource('mobile/covers', AdminMobileCoversController::class);


        // SETTINGS
        // Route::get('settings/edit', [AdminSettingsController::class, 'edit']);
        // Route::post('settings/update', [AdminSettingsController::class, 'update']);

        //subscribers

        Route::get('/subscribers', [AdminSubscribersController::class, 'index']);

        //contacts

        Route::get('/contacts', [AdminContactsController::class, 'index']);

        // PROFILE
        Route::get('profile/edit', [AdminProfileController::class, 'edit']);
        Route::post('profile/update', [AdminProfileController::class, 'update'])->name('adminProfile.update');
        Route::get('profile/password/edit', [AdminProfileController::class, 'editPassword'])->name('adminProfile.password');
        Route::post('profile/password/update', [AdminProfileController::class, 'updatePassword'])->name('adminProfile.password.update');
        Route::get('profile/logout', [AdminProfileController::class, 'logout']);


        //social logins

        Route::get('/social', [AdminSocialLinkController::class, 'index'])->name('admin.social');
        Route::get('/social/create', [AdminSocialLinkController::class, 'create'])->name('admin.social.create');
        Route::post('/social/store', [AdminSocialLinkController::class, 'store'])->name('admin.social.store');
        Route::get('/social/edit/{id}', [AdminSocialLinkController::class, 'edit'])->name('admin.social.edit');
        Route::put('/social/update/{id}', [AdminSocialLinkController::class, 'update'])->name('admin.social.update');
        Route::delete('/social/{id}', [AdminSocialLinkController::class, 'destroy']);

        // User management
        Route::resource('users' , UserController::class);

        // Role management
        Route::resource('roles' , RoleController::class);
    });
