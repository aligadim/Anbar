<?php

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
Route::group(['middleware'=>'notlogin'],function(){

        Route::get('/','App\Http\Controllers\brendController@index')->name('brend'); 
        

        Route::post('/brend','App\Http\Controllers\brendController@brend')->name('brendForm');

      

        Route::get('/brend_sil/{id}','App\Http\Controllers\brendController@brend_sil')->name('brend_sil');

        Route::get('/brend_del/{id}','App\Http\Controllers\brendController@brend_del')->name('brend_del');

        Route::get('/brend_edit/{id}','App\Http\Controllers\brendController@brend_edit')->name('brend_edit');

        Route::post('/brend_update/{id}','App\Http\Controllers\brendController@brend_update')->name('brend_update');







        Route::get('/client','App\Http\Controllers\clientController@index')->name('client');

        Route::post('/client','App\Http\Controllers\clientController@clients')->name('clientForm');

        Route::get('/sil/{id}','App\Http\Controllers\clientController@sil')->name('sil');

        Route::get('/del/{id}','App\Http\Controllers\clientController@del')->name('del');

        Route::get('/edit/{id}','App\Http\Controllers\clientController@edit')->name('edit');

        Route::post('/update/{id}','App\Http\Controllers\clientController@update')->name('update');


        Route::get('/xerc', 'App\Http\Controllers\xercController@index')->name('xerc');

        Route::post('/xerc','App\Http\Controllers\xercController@xerc')->name('xercForm');

        Route::get('/xerc_sil/{id}', 'App\Http\Controllers\xercController@xerc_sil')->name('xerc_sil');

        Route::get('/xerc_del/{id}', 'App\Http\Controllers\xercController@xerc_del')->name('xerc_del');

        Route::get('/xerc_edit/{id}', 'App\Http\Controllers\xercController@xerc_edit')->name('xerc_edit');

        Route::post('/xerc_update/{id}', 'App\Http\Controllers\xercController@xerc_update')->name('xerc_update');



        Route::get('/product','App\Http\Controllers\ProductsController@index')->name('product');

        Route::post('/product','App\Http\Controllers\ProductsController@product')->name('productForm');

        Route::get('/pr_sil/{id}','App\Http\Controllers\ProductsController@pr_sil')->name('pr_sil');

        Route::get('/pr_del/{id}','App\Http\Controllers\ProductsController@pr_del')->name('pr_del');


        Route::get('/pr_edit/{id}','App\Http\Controllers\ProductsController@pr_edit')->name('pr_edit');

        Route::post('/pr_update/{id}','App\Http\Controllers\ProductsController@pr_update')->name('pr_update');


        Route::get('/orders','App\Http\Controllers\OrdersController@index')->name('orders');

        Route::post('/orders','App\Http\Controllers\OrdersController@orders')->name('orderForm');

        Route::get('/orders_sil/{id}','App\Http\Controllers\OrdersController@orders_sil')->name('orders_sil');

        Route::get('/orders_del/{id}','App\Http\Controllers\OrdersController@orders_del')->name('orders_del');

        Route::get('/orders_edit/{id}','App\Http\Controllers\OrdersController@orders_edit')->name('orders_edit');

        Route::post('/orders_update/{id}','App\Http\Controllers\OrdersController@orders_update')->name('orders_update');

        Route::get('/tesdiq/{id}','App\Http\Controllers\OrdersController@tesdiq')->name('tesdiq');

        Route::get('/legv/{id}','App\Http\Controllers\OrdersController@legv')->name('legv');

        Route::get('/logout','App\Http\Controllers\LoginController@logout')->name('logout');







        
        
        Route::get('/profil','App\Http\Controllers\profilController@index')->name('profil');

        Route::post('/profil_update','App\Http\Controllers\profilController@profil_update')->name('profil_update');

        Route::get('/profil_edit/{id}','App\Http\Controllers\profilController@profil_edit')->name('profil_edit');




        Route::get('/staff','App\Http\Controllers\staffController@index')->name('staff');


        Route::post('/staff','App\Http\Controllers\staffController@staff')->name('staff_Form');
        
        Route::get('/staff_edit/{id}','App\Http\Controllers\staffController@staff_edit')->name('staff_edit');


        Route::post('/s_update/{id}','App\Http\Controllers\staffController@s_update')->name('s_update');

        Route::get('/staff_sil/{id}','App\Http\Controllers\staffController@staff_sil')->name('staff_sil');

        Route::get('/s_del/{id}','App\Http\Controllers\staffController@s_del')->name('s_del');



        Route::get('/vezife','App\Http\Controllers\vezifeController@index')->name('vezife');

        Route::post('/vezife','App\Http\Controllers\vezifeController@vezife')->name('vezifeForm');

        Route::get('/v_sil/{id}','App\Http\Controllers\vezifeController@v_sil')->name('v_sil');

        Route::get('/v_del/{id}','App\Http\Controllers\vezifeController@v_del')->name('v_del');

        Route::get('/v_edit/{id}','App\Http\Controllers\vezifeController@v_edit')->name('v_edit');
        
        Route::post('/v_update/{id}','App\Http\Controllers\vezifeController@v_update')->name('v_update');


        Route::get('/shobe','App\Http\Controllers\shobeController@index')->name('shobe');

        Route::post('/shobe','App\Http\Controllers\shobeController@shobe')->name('shobeForm');
          
        Route::get('/shobe_sil/{id}','App\Http\Controllers\shobeController@shobe_sil')->name('shobe_sil');

        Route::get('/shobe_del/{id}','App\Http\Controllers\shobeController@shobe_del')->name('shobe_del');

        Route::get('/shobe_edit/{id}','App\Http\Controllers\shobeController@shobe_edit')->name('shobe_edit');

        Route::post('/shobe_update/{id}','App\Http\Controllers\shobeController@shobe_update')->name('shobe_update');
  

        Route::get('/docs/{id}','App\Http\Controllers\docsController@index')->name('docs');

        Route::post('/docs/{id}','App\Http\Controllers\docsController@docs')->name('docsForm');

        Route::get('/docs_sil/{id}','App\Http\Controllers\docsController@docs_sil')->name('docs_sil');

        Route::get('/docs_del/{id}','App\Http\Controllers\docsController@docs_del')->name('docs_del');

        Route::get('/docs_edit/{id}','App\Http\Controllers\docsController@docs_edit')->name('docs_edit');

        Route::post('/docs_update/{id}','App\Http\Controllers\docsController@docs_update')->name('docs_update');



        Route::get('/komendant','App\Http\Controllers\komendantController@index')->name('komendant');

        Route::post('/komendantForm','App\Http\Controllers\komendantController@komendant')->name('komendantForm');

        Route::get('/k_sil/{id}','App\Http\Controllers\komendantController@k_sil')->name('k_sil');

        Route::get('/k_del/{id}','App\Http\Controllers\komendantController@k_del')->name('k_del');

        Route::get('/k_edit/{id}','App\Http\Controllers\komendantController@k_edit')->name('k_edit');

        Route::post('/k_update/{id}','App\Http\Controllers\komendantController@k_update')->name('komendant_update');

        Route::post('/komendant','App\Http\Controllers\komendantController@komendant_say')->name('komendant_say');
         

        Route::get('/tproduct/{id}','App\Http\Controllers\ProductsController@tproduct')->name('tproduct');

        Route::get('/tehcizat','App\Http\Controllers\tehcizatController@index')->name('tehcizat');

        Route::post('/tehcizatForm','App\Http\Controllers\tehcizatController@tehcizat')->name('tehcizatForm');
       
        Route::get('/t_sil/{id}','App\Http\Controllers\tehcizatController@t_sil')->name('t_sil');

        Route::get('/t_del/{id}','App\Http\Controllers\tehcizatController@t_del')->name('t_del');

        Route::get('/t_edit/{id}','App\Http\Controllers\tehcizatController@t_edit')->name('t_edit');

        Route::post('/t_update/{id}','App\Http\Controllers\tehcizatController@t_update')->name('t_update');

        Route::get('/admin','App\Http\Controllers\UserController@admin')->name('admin');

        Route::post('/admin','App\Http\Controllers\UserController@user')->name('adminForm');

        Route::get('/blok/{id}','App\Http\Controllers\UserController@blok')->name('blok');

        Route::get('/anblok/{id}','App\Http\Controllers\UserController@anblok')->name('anblok');

       


});
Route::group(['middleware'=>'islogin'],function(){

        Route::get('/user','App\Http\Controllers\UserController@userindex')->name('user');

        Route::post('/user','App\Http\Controllers\UserController@user')->name('userForm');

        Route::get('/login','App\Http\Controllers\LoginController@index')->name('login');

        Route::post('/login','App\Http\Controllers\LoginController@login')->name('loginForm');
});






