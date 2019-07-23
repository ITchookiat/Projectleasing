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
    return redirect('/home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function()
  {
    //admin register
    Route::get('/maindata/register', 'UserController@register')->name('regist');
    Route::post('/maindata/saveregister', 'UserController@Saveregister')->name('Saveregist');

    Route::get('/maindata/view', 'UserController@index')->name('ViewMaindata');
    Route::get('/maindata/edit/{id}', 'UserController@edit')->name('maindata.edit');
    Route::patch('/maindata/update/{id}', 'UserController@update')->name('maindata.update');
    Route::delete('/maindata/delete/{id}', 'UserController@destroy')->name('maindata.destroy');

    route::resource('MasterAnalysis','AnalysController');
    Route::get('/Analysis/Home/{type}', 'AnalysController@index')->name('Analysis');
    Route::get('/Analysis/edit/{id}', 'AnalysController@edit')->name('Analysis.edit');
    Route::patch('/Analysis/update/{id}', 'AnalysController@update')->name('Analysis.update');
    Route::delete('/Analysis/delete/{id}', 'AnalysController@destroy')->name('Analysis.destroy');
    Route::get('/Analysis/Report/{id}', 'ReportAnalysController@ReportPDFIndex');
    Route::get('/Analysis/ReportDueDate', 'ReportAnalysController@ReportDueDate');

    // route::resource('Call','CallController');
    Route::get('/call/viewdetail/{Str1}/{Str2}', 'CallController@viewdetail')->name('callDetail.viewdetail');
    Route::get('/call/{type}', 'CallController@index')->name('call');
    Route::get('/Reportcall/{type}', 'ReportCallController@index')->name('reportcall');
    Route::get('/monthreport/{type}/{fmonth}/{fyear}', 'ReportCallController@monthReport')->name('monthreport');
    Route::get('/ReportCall/{type}', 'ReportCallController@update')->name('ReportCall.update');
    route::resource('ReportCall','ReportCallController');

    Route::get('/finance/{type}', 'FinanceController@index')->name('finance');


    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/{name}', 'HomeController@index')->name('index');

  });
