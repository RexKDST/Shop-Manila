<?php


Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');


Route::get('/range', function() {
    return view('range');
});
Route::post('addReview', 'HomeController@addReview');
Route::get('/product_details/{id}', 'HomeController@product_details');
Route::get('selectSize', 'HomeController@selectSize');
Route::get('selectColor', 'HomeController@selectColor');

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/shop', 'HomeController@shop');

Route::get('/products', 'HomeController@shop');
Route::get('/products/{name}', 'HomeController@proCats');

Route::get('/contact', 'HomeController@contact');
Route::post('/search', 'HomeController@search');
Route::get('/cart', 'CartController@index');

Route::get('/cart/addItem/{id}', 'CartController@addItem');

Route::get('/cart/remove/{id}', 'CartController@destroy');
Route::get('/cart/update/{id}', 'CartController@update');

Route::get('/newArrival', 'HomeController@newArrival');

// logged in user pages
Route::group(['middleware' => 'auth'], function() {
    Route::get('/checkout', 'CheckoutController@index');
    Route::post('/formvalidate', 'CheckoutController@formvalidate');

    Route::get('/profile', function() {
        return view('profile.index');
    });
    Route::get('/orders', 'ProfileController@orders');
    

    Route::POST('/message', 'ProfileController@message');
    Route::get('/message', 'ProfileController@messageform');

    Route::get('/address', 'ProfileController@address');
    Route::post('/updateAddress', 'ProfileController@UpdateAddress');

    Route::get('/password', 'ProfileController@Password');
    Route::post('/updatePassword', 'ProfileController@updatePassword');

    Route::get('/thankyou', function() {
        return view('profile.thankyou');
    });

    Route::get('/mail', 'HomeController@sendmail');

     Route::get('/chatbot', 'HomeController@chatbot');

});

Auth::routes();

//admin links
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/', 'AdminController@index');

   Route::get('/message', 'AdminController@view_messages');

    Route::get('/addProduct', 'AdminController@addpro_form');
     Route::POST('/add_product', 'AdminController@add_product');
    Route::get('/products', 'AdminController@view_products');
    Route::POST('/editProduct', 'AdminController@editProduct');
    Route::get('/deleteProducts/{id}', 'AdminController@deleteProducts');
     Route::get('/deleteOrders/{id}', 'AdminController@deleteOrders');
     Route::get('/deleteSuppliers/{id}', 'AdminController@deleteSuppliers');
     Route::get('/deleteUser/{id}', 'AdminController@deleteUser');
    Route::get('/addStocks','AdminController@addStocks');
    Route::POST('/add_stocks','AdminController@add_stocks');
    Route::POST('/editStock','AdminController@editStock');
    Route::get('/stockDetails','AdminController@view_stockDetails');
    Route::get('StockEditForm/{id}', 'AdminController@StockEditForm');

    Route::get('/addSales','AdminController@addSales');
    Route::get('/sales','AdminController@view_sales');
    Route::get('/salesDatatable','AdminController@salesDatatable');
    Route::get('/productsDatatable','AdminController@productsDatatable');
    Route::get('/cancel','AdminController@view_cancel');
    Route::get('/refund','AdminController@view_refund');
    Route::POST('/add_sales','AdminController@add_sales');
    Route::get('/salesDetails','AdminController@view_salesDetails');
    Route::post('/editPrint', 'AdminController@editPrint');
    Route::get('/PrintForm/{id}', 'AdminController@PrintForm');

    Route::get('/addSupplier','AdminController@addSupplier');
    Route::get('/suppliers','AdminController@view_supplier');
    Route::POST('/add_supplier','AdminController@add_supplier');
    Route::get('/supliersDetails','AdminController@view_supplier');

    Route::get('/products/{name}', 'AdminController@proCats');
    Route::get('/products', 'AdminController@view_products')->name('product.view_products');

    
    Route::get('/stocks','AdminController@view_stocks');
    Route::get('/deleteStockDetails/{id}', 'AdminController@deleteStockDetails');

    Route::get('/orderDetails', 'AdminController@orders');
    Route::get('/deleteOrderDetails/{id}', 'AdminController@deleteOrderDetails');
    Route::get('/OrderEditForm/{id}', 'AdminController@OrderEditForm');
    Route::POST('/editOrder', 'AdminController@editOrder');
    Route::get('OrderEditForm/{id}', 'AdminController@OrderEditForm');
    Route::POST('/editOrder', 'AdminController@editOrder');

    Route::get('/addCat', 'AdminController@add_cat');
    Route::get('/productCategory', 'AdminController@productCategory');
     Route::get('/stockCategory', 'AdminController@stockCategory');

    Route::POST('/catForm', 'AdminController@catForm');
    Route::get('/categories', 'AdminController@view_cats');
    Route::get('/CatEditForm/{id}', 'AdminController@CatEditForm');

    Route::POST('/editCat', 'AdminController@editCat');
    Route::get('ProductEditForm/{id}', 'AdminController@ProductEditForm');
    Route::get('ProductEditForm/{id}', 'AdminController@ProductEditForm');

    Route::get('ViewMessage/{id}', 'AdminController@ViewMessage');
    Route::get('deleteMessage/{id}', 'AdminController@deleteMessage');

    Route::post('/send', 'AdminController@send');
    Route::get('/email', 'AdminController@email');


    Route::get('EditImage/{id}', 'AdminController@ImageEditForm');
    Route::post('editProImage', 'AdminController@editProImage');
    Route::get('deleteCategory/{id}', 'AdminController@deleteCategory');
    Route::get('/addProperty/{id}', function($id){
      return view('admin.addProperty')->with('id', $id);
    });
    Route::get('/addPropertyAll', function(){
      return view('admin.addProperty');
    });
    Route::post('submitProperty','AdminController@submitProperty');
    Route::post('editProperty','AdminController@editProperty');
    Route::get('addSale', 'AdminController@addSale');

    Route::get('addAlt/{id}', 'AdminController@addAlt');
    Route::post('submitAlt','AdminController@submitAlt');
    Route::get('/users','AdminController@users');
    Route::get('/updateRole','AdminController@updateRole');

 Route::get('/ascending', 'AdminController@ascending');
    Route::get('/descending', 'AdminController@descending');
    Route::get('/highest', 'AdminController@highest');
    Route::get('/lowest', 'AdminController@lowest');
    Route::get('/highPrice', 'AdminController@highPrice');
    Route::get('/lowPrice', 'AdminController@lowPrice');
    Route::get('/sortFive', 'AdminController@sortFive');
     Route::get('/sortTen', 'AdminController@sortTen');

     //sort ng products
    Route::get('/ascPro', 'AdminController@ascPro');
    Route::get('/descPro', 'AdminController@descPro');  
    Route::get('/highPro', 'AdminController@highPro');
    Route::get('/lowPro', 'AdminController@lowPro');

    //sort ng stocks
    Route::get('/ascStock', 'AdminController@ascStock');
     Route::get('/descStock', 'AdminController@descStock');

     //sort ng users
     Route::get('/ascUsers', 'AdminController@ascUsers');
      Route::get('/descUsers', 'AdminController@descUsers');
       Route::get('/ascName', 'AdminController@ascName');
       Route::get('/descName', 'AdminController@descName');
       Route::get('/adminName', 'AdminController@adminName');

    //sort ng orders
        Route::get('/deliveredOrders', 'AdminController@deliveredOrders');
        Route::get('/cancelledOrders', 'AdminController@cancelledOrders');
         Route::get('/refundedOrders', 'AdminController@refundedOrders');
          Route::get('/pendingOrders', 'AdminController@pendingOrders');
    Route::get('/updateSale','AdminController@updateSale');

     Route::post('/searchProduct', 'AdminController@searchProduct');
     Route::post('/searchStock', 'AdminController@searchStock');
     Route::post('/searchOrder', 'AdminController@searchOrder');
     Route::post('/searchOrderID', 'AdminController@searchOrderID');
      Route::post('/searchSales', 'AdminController@searchSales');
      Route::post('/searchUser', 'AdminController@searchUser');

    Route::post('import_products','AdminController@import_products');

     Route::get('/export_products','AdminController@export_products');
     Route::get('/export_sales','AdminController@export_sales');
      Route::get('/export_stocks','AdminController@export_stocks');

});
Route::get('/logout', 'Auth\LoginController@logout');
Route::post('addToWishList', 'HomeController@wishList');
Route::get('/WishList', 'HomeController@View_wishList');
Route::get('/removeWishList/{id}', 'HomeController@removeWishList');
//Route::get('/admin', 'AdminController@index');
 Route::get('/users','AdminController@users');
    Route::get('/updateRole','AdminController@updateRole');

   

    //sort ng sales
   