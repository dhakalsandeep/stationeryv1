<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');
});


//Items
Route::get('/item','ItemsController@index')->name('item.index');
Route::get('/item/create', 'ItemsController@create')->name('item.create');
Route::get('/item/{item}/edit', 'ItemsController@edit')->name('item.edit');
Route::post('/item', 'ItemsController@store')->name('item.store');
Route::post('/item/{item}', 'ItemsController@update')->name('item.update');

//Purchase
Route::get('/purchase','PurchasesController@index')->name('purchase.index');
Route::get('/purchase/create', 'PurchasesController@create')->name('purchase.create');
Route::get('/purchase/{purchase}/edit', 'PurchasesController@edit')->name('purchase.edit');
Route::post('/purchase', 'PurchasesController@store')->name('purchase.store');
Route::get('/purchase/print/{id}', 'PurchasesController@print_purchase')->name('purchase.print');
Route::post('/purchase/{purchase}', 'PurchasesController@update')->name('purchase.update');
Route::get('/purchase/purchase-no', 'PurchasesController@get_new_purchase_no')->name('get.purchase.no');

//Issue
Route::get('/issue','IssuesController@index')->name('issue.index');
Route::get('/issue/create', 'IssuesController@create')->name('issue.create');
Route::get('/issue/{issue}/edit', 'IssuesController@edit')->name('issue.edit');
Route::post('/issue', 'IssuesController@store')->name('issue.store');
Route::get('/issue/print/{id}', 'IssuesController@print_issue')->name('issue.print');
Route::post('/issue/{issue}', 'IssuesController@update')->name('issue.update');
Route::get('/issue/issue-no', 'IssuesController@get_new_issue_no')->name('get.issue.no');
Route::get('/issue/items-edition/{id}', 'IssuesController@get_items_edition')->name('get.items.edition');

//Suppliers
Route::get('/supplier','SuppliersController@index')->name('supplier.index');
Route::get('/supplier/create', 'SuppliersController@create')->name('supplier.create');
Route::get('/supplier/{supplier}/edit', 'SuppliersController@edit')->name('supplier.edit');
Route::post('/supplier', 'SuppliersController@store')->name('supplier.store');
Route::post('/supplier/{supplier}', 'SuppliersController@update')->name('supplier.update');

//Items Management
Route::get('/stock','StocksController@index')->name('stock.index');
Route::get('/stock/create', 'StocksController@create')->name('stock.create');
Route::get('/stock/{stock}/edit', 'StocksController@edit')->name('stock.edit');
Route::post('/stock', 'StocksController@store')->name('stock.store');
Route::post('/stock/{stock}', 'StocksController@update')->name('stock.update');

//Publishers
Route::get('/publisher','PublishersController@index')->name('publisher.index');
Route::get('/publisher/create', 'PublishersController@create')->name('publisher.create');
Route::get('/publisher/{publisher}/edit', 'PublishersController@edit')->name('publisher.edit');
Route::get('/publisher/{publisher}', 'PublishersController@show')->name('publisher.show');
Route::post('/publisher', 'PublishersController@store')->name('publisher.store');
Route::post('/publisher/{publisher}', 'PublishersController@update')->name('publisher.update');
Route::delete('/publisher/{publisher}', 'PublishersController@destroy')->name('publisher.destroy');
Route::delete('publisher/destroy', 'PublishersController@massDestroy')->name('publisher.massDestroy');


//Purchase Detail Report
Route::get('/purchase-detail-report','PurchaseDetailReportsController@index')->name('purchase.detail.report.index');
Route::get( '/purchase-detail-report/fetch_data', 'PurchaseDetailReportsController@fetch_data')->name('get.purchase.reports.fetchdata');
Route::post('/purchase-detail-report/print', 'PurchaseDetailReportsController@print_purchase_detail_report')->name('purchase.detail.report.print');
//Route::post('/purchase-detail-report/print', function (){
//    return "Success";
//})->name('purchase.detail.report.print');
