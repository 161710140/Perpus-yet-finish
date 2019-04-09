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

Route::get('/', function () {
    return view('home');
});

Route::get('/success',function (){
   return view('success');
});

Route::get('/home2',function (){
   return view('home2');
});

Route::get('/export_excel/excel', 'PinjamBukuController@excel')->name('export_excel.excel');

Route::get('nama/{id}',array('as'=>'myform.ajax','uses'=>'PinjamBukuController@KelasSiswa'));
//Siswa
Route::get('/jsonSiswa','SiswaController@json');
Route::resource('/siswa','SiswaController');
Route::post('storesiswa','SiswaController@store')->name('tambah');
Route::get('ajaxdata/removedatasiswa', 'SiswaController@removedata')->name('ajaxdata.removedatasiswa');
Route::post('siswa/edit/{id}','SiswaController@update');
Route::get('siswa/getedit/{id}','SiswaController@edit');
Route::get('ajaxdata/massremove', 'SiswaController@massremove')->name('ajaxdata.massremove');

//Kelas
Route::get('/jsonkelas','KelasController@jsonkelas');
Route::resource('/kelas','KelasController');
Route::post('storekelas','KelasController@store')->name('tambah');
Route::get('ajaxdata/removedatakelas', 'KelasController@removedata')->name('ajaxdata.removedatakelas');
Route::post('kelas/edit/{id}','KelasController@update');
Route::get('kelas/getedit/{id}','KelasController@edit');
Route::get('ajaxdata/massremovekelas', 'KelasController@massremove')->name('ajaxdata.massremovekelas');


//Buku
Route::get('/jsonbuku','BukuController@jsonbuku');
Route::resource('/buku','BukuController');
Route::post('storebuku','BukuController@store')->name('tambah');
Route::get('ajaxdata/removedatabuku', 'BukuController@removedata')->name('ajaxdata.removedatabuku');
Route::post('buku/edit/{id}','BukuController@update');
Route::get('buku/getedit/{id}','BukuController@edit');
Route::get('ajaxdata/massremovebuku', 'BukuController@massremove')->name('ajaxdata.massremovebuku');


//Pinjam
Route::get('/jsonpinjam','PinjamBukuController@jsonpinjam');
Route::resource('/pinjam','PinjamBukuController');
Route::post('storepinjam','PinjamBukuController@store')->name('tambah');
Route::post('pinjam/edit/{id}','PinjamBukuController@update');
Route::get('pinjam/getedit/{id}','PinjamBukuController@edit');

//Pengembalian
Route::get('/jsonpengembalian','PinjamBukuController@jsonpengembalian');
Route::get('/pengembalian','PinjamBukuController@index2');
Route::post('storepengembalian','PinjamBukuController@store2')->name('tambah');
Route::post('pinjamm/edit/{id}','PinjamBukuController@update2');
Route::get('pinjam/pengembalian/{id}',array('as'=>'myform.ajax','uses'=>'PinjamBukuController@getedit'));


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
