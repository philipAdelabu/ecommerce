<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$base = "App\Http\Controllers\\";


Route::view('blank', 'general.pages.blank');
Route::get('search', [PagesController::class, 'getSearch']); 
Route::post('/search', [PagesController::class, 'postSearch']);
Route::get('/', [PagesController::class, 'getIndex']);
Route::get('lg/user', [PagesController::class, 'getLogin']);

Route::prefix('pages')->group(function(){
    Route::get('about-us', [PagesController::class, 'getAbout']);
    Route::get('contact-information', [PagesController::class, 'getContactInformation']);
    Route::get('order-lookup', [PagesController::class, 'getOrderLookUp']);
    
});

Route::prefix('policies')->group(function(){
    Route::get('privacy-policy', [PagesController::class, 'getPrivacyPolicy']);
    Route::get('drop-shipping', [PagesController::class, 'getDropShipping']);
    Route::get('terms-and-conditions', [PagesController::class, 'getTermConditions']);
    Route::get('refund-policy', [PagesController::class, 'getRefundPolicy']);
    Route::get('shipping-policy', [PagesController::class, 'getShippingPolicy']);
    Route::get('warranty-policy', [PagesController::class, 'getWarrantyPolicy']);
});

Route::prefix('collections')->group( function(){
     Route::get('laptops', [PagesController::class, 'getLaptops']);
     Route::get('accessories', [PagesController::class, 'getAccessories']);
     Route::get('phones-tablets', [PagesController::class, 'getPhonesTablets']);
     Route::get('custom-payment', [PagesController::class, 'getCustomPayment']);
     Route::get('computer-components', [PagesController::class, 'getComputerComponents']);
     Route::get('latest-products', [PagesController::class, 'getLatestProducts']);
     Route::get('best-selling', [PagesController::class, 'getBestSelling']);
     Route::get('computer-components', [PagesController::class, 'getComputerComponents']);
     Route::get('desktops-all-in-one', [PagesController::class, 'getDesktopAllInOne']);
     Route::get('all', [PagesController::class, 'getAllProducts']);
});

Route::get('products/{status}/{id}', [PagesController::class, 'getSingleProductDetails']);
Route::post('add/cart', [PagesController::class, 'postAddCart'])->name('add_cart');

////////////////////// Routes related to products and search ////////////////////////////


$base = "App\Http\Controllers\\";
Route::post('product/search', $base.'PagesController@getProductName');
Route::get('specific/item/{status}/{id}/{title?}', $base.'PagesController@getProductDetail');
Route::get('product_summary', $base.'PagesController@getProduct_summary');
Route::get('view_cart', $base.'PagesController@getViewCart');
Route::get('updatecart/{item_id}/{quantity}/{session_id}', $base.'PagesController@getUpdateCart');
Route::get('check_out', $base.'PagesController@getCheckOut');
Route::get('delivery_address', $base.'PagesController@getDeliveryAddress');
Route::get('item/view/catg/{catg_id}', $base.'PagesController@getItemViewCategory');
Route::get('item/view/sub_catg/{sub_catg_id}', $base.'PagesController@getItemViewSubCategory');
Route::get('forget_password', $base.'PagesController@getForgetPassword');
Route::get('user_signup', $base.'PagesController@getSignup');
Route::get('products', $base.'PagesController@getProducts');
Route::get('special_offer', $base.'PagesController@getSpecial_offer');
Route::get('final_submit', $base.'PagesController@getFinalSubmit'); 
Route::get('login_page', $base.'PagesController@getLoginPage');
Route::get('user/logout', $base.'PagesController@getUserLogout');
Route::get('user/reset', $base.'PagesController@getUserReset');
Route::get('user/login', $base.'PagesController@getUserLogin');
Route::get('user/history', $base.'PagesController@getUserHistory');
Route::get('cancel/item/{id}', $base.'PagesController@getCancelItem');
Route::get('getCongrat', $base.'PagesController@getCongrat');
Route::get('account', $base.'PagesController@getAccount');

Route::get('online_payment', $base.'PagesController@getOnlinePayment');
Route::get('pay_to_account', $base.'PagesController@getPayToAccount');
Route::get('confirm/product/order', $base.'PagesController@getConfirmProductOrder');





////////////////////////////////////////////////////////////////
////////////////////// ADMIN SECTION  ///////////////////////////
/////////////////////////////////////////////////////////////////

//Route::get('login/admin', function(){ return view('admin.login'); });
Route::get('login/admin',$base.'AdminController@getLoginPage');
Route::post('adminReset', $base.'AdminController@getAdminReset');
Route::get('adminLogout', $base.'AdminController@getAdminLogout');
Route::post('adminlogin', $base.'AdminController@getAdminLogin');


Route::middleware([CheckAdmin::class])->group(function(){
    $base = "App\Http\Controllers\\";
    // All the get request route come here
    Route::get('add_category', $base.'AdminController@getAddCategory');
    Route::get('view_category', $base.'AdminController@getViewCategory');
    Route::get('admin/edit/item/{type}/{id}', $base.'AdminController@getAdminEditItem');
    Route::get('admin/delete/item/{type}/{id}', $base.'AdminController@getAdminDeleteItem');
    Route::get('admin_add_product', $base.'AdminController@getAdminAddProduct');
    Route::get('get/subCategory/{id}', $base.'AdminController@getSubCategory');
    Route::get('admin_update_item/get/subCategory/{id}/{category}', $base.'AdminController@getSubCategory1');
    Route::get('admin_view_item_detail/{sub_catg_id?}', $base.'AdminController@getAdminItemDetail');
    Route::get('admin_view_item', $base.'AdminController@getAdminViewItem');
    Route::get('admin/specific/item/{status}/{id}', $base.'AdminController@getAdminSpecificItem');
    Route::get('admin_update_item/{id}', $base.'AdminController@getAdminUpdateItem')->name('admin_update_item');
    Route::get('admin/item/detail/{sub_catg_id?}', $base.'AdminController@getAdminItemDetail');
    Route::get('admin_add_seller', $base.'AdminController@getAdminAddSeller');
    Route::get('seller_created', $base.'AdminController@getSellerCreated');
    Route::get('admin/logout', $base.'AdminController@getAdminLogout');
    Route::get('admin/view/supplier/items', $base.'AdminController@getAdminViewSupplierItems');
    Route::get('admin/seller/items/{id}', $base.'AdminController@getAdminSellerItems');
    Route::get('admin/seller/specific/item/{status}/{id}/{seller_id}', $base.'AdminController@getAdminSellerSpecificItem');
    Route::get('admin/view/purchase/item', $base.'AdminController@getAdminViewPurchaseItem');
    Route::get('admin/item/purchase/{status}/{id}', $base.'AdminController@getAdminItemPurchase');
    Route::get('admin/transaction/detail/{trans_id}/{buyer_id}/{seller_id?}', $base.'AdminController@getAdminTransactionDetail');
    Route::get('users', $base.'AdminController@getUsers');
    Route::get('buyers', $base.'AdminController@getBuyers');
    Route::get('admin/user/{status}/{id}', $base.'AdminController@getAdminUser');
    Route::get('admin/add/featured', $base.'AdminController@getAdminAddFeatured');
    Route::get('admin/add/banner', $base.'AdminController@getAdminAddBanner');
    Route::get('admin/add/special', $base.'AdminController@getAdminAddSpecial');
    Route::get('admin/delete/{item}/{id?}', $base.'AdminController@getAdminRemoveItem');
    Route::get('admin/password/reset', $base.'AdminController@getAdminPasswordReset');
    Route::get('admin/add/marquee', $base.'AdminController@getMarquee');
    Route::get('delete/scrolling/text', $base.'AdminController@getDeleteScrollingText');
    Route::get('view_all_item', $base.'AdminController@getViewAllItems');
    Route::get('admin/view/specific/item/{status}/{id}', $base.'AdminController@getAdminViewSpecificItem');
    Route::get('admin_delete_BannerAd', $base.'AdminController@getAdminDeleteBannerAd');
     
    //Section that create administrator
    Route::get('admin_add_admin', $base.'AdminController@getAdminAddAdmin');
    Route::get('admin/manage/admin', $base.'AdminController@getAdminManageAdmin');
    Route::get('admin/view/admin/sellers', $base.'AdminController@getAdminViewAdminSeller');
    Route::get('admin_created', $base.'AdminController@getAdminCreated');
    Route::get('admin/admin/{status}/{id}', $base.'AdminController@getAdminManageAdministrator');
    Route::get('admin/seller/admin/{id}', $base.'AdminController@getAdminAdminSeller');
    Route::get('admin/view/sub_admin/items', $base.'AdminController@getAdminViewSubAdminItems');
    Route::get('admin/sub_admin/items/{id}', $base.'AdminController@getAdminSubAdminItems');
    Route::get('admin/admin/specific/item/{status}/{id}/{admin_id}', $base.'AdminController@getAdminAdminSpecificItem');
    
   
    Route::post('create/admin', $base.'AdminController@postCreateAdmin');
   
   Route::get('admin/manage/supplier', $base.'AdminController@getAdminManageSupplier');
   Route::get('admin/supplier/{status}/{id}', $base.'AdminController@getAdminManageSeller');
   
   
    //All the post requests route come here
    Route::post('add_category', $base.'AdminController@postAddCategory');
    Route::post('add_sub_category', $base.'AdminController@postSubCategory');
    Route::post('admin_update_item', $base.'AdminController@postAdminUpdateItem');
    Route::post('admin_add_product', $base.'AdminController@postAdminAddProduct');
    Route::post('admin/search/content', $base.'AdminController@postAdminSearchContent');
    Route::post('create/seller', $base.'AdminController@postCreateSeller');
    Route::post('admin/add/featured', $base.'AdminController@postAdminAddFeatured');
    Route::post('admin/add/banner', $base.'AdminController@postAdminAddBanner');
    Route::post('admin/add/special', $base.'AdminController@postAdminAddSpecial');
    Route::post('admin/password/reset', $base.'AdminController@postAdminPasswordReset');
    Route::post('add_marquee', $base.'AdminController@postAddMarquee');
    Route::post('admin/add/banner_ad', $base.'AdminController@postAdminAddBannerAd');
    
   
   Route::get('admin_dashboard', $base.'AdminController@getAdminDashboard');
   Route::get('adminDashboard', $base.'AdminController@getAdminDashboard');
       
   
   
   
   Route::get('admin_search', $base.'AdminController@getAdminSearch');
   
   
   Route::get('admin_change_password', $base.'AdminController@getAdminPasswordChange');
   
   
                  //// POST SECTION ////
   
   Route::post('find_user',$base.'AdminController@getFindUser');
   Route::post('admin_set_last_day', $base.'AdminController@postAdminSetLast');
   Route::post('admin_change_password', $base.'AdminController@postAdminPasswordChange');
   
   
   /// The admin blogging routing
   Route::get('admin_add_news', $base.'BlogController@getAdminAddNews');
   Route::get('admin_view_news', $base.'BlogController@getAdminViewNews');
   Route::get('admin_view_news/{category?}', $base.'BlogController@getAdminViewNews');
   Route::get('admin/specific/news/{status}/{id}', $base.'BlogController@getAdminSpecificNews');
   Route::get('admin_update_news/{id}', $base.'BlogController@getAdminUpdateNews')->name('admin_update_news');
   
    //All the post requests route come here
    Route::post('admin_add_news', $base.'BlogController@postAdminAddNews');
   
   
     //All the post requests route come here
     Route::post('admin_add_news', $base.'BlogController@postAdminAddNews');
   
     // Last updated information 
     Route::get('admin/update/information', $base.'AdminController@getUpdateInformation');
     Route::post('admin/update/information', $base.'AdminController@postUpdateInformation');
    
     Route::get('admin/update/{about}', $base.'AdminController@getUpdateGeneralInformation');
     Route::get('admin/update/terms}', $base.'AdminController@getUpdateGeneralInformation');
     Route::get('admin/update/{shipping}', $base.'AdminController@getUpdateGeneralInformation');
    
    
     Route::post('admin/update/about', $base.'AdminController@postUpdateGeneralInformation');
     Route::post('admin/update/terms', $base.'AdminController@postUpdateGeneralInformation');
     Route::post('admin/update/shipping', $base.'AdminController@postUpdateGeneralInformation');
     Route::post('admin/show/item/visibility', $base.'AdminController@postAdjustItemVisibility');
    
    Route::get('admin/view/sub_cat/{sub_cat}', $base.'AdminController@getViewSubCategoryItems');
   
   });
   
   
   


