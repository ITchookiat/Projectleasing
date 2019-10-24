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
    Route::get('/Analysis/edit/{id}/{type}/{fdate}/{tdate}/{branch}/{status}', 'AnalysController@edit')->name('Analysis.edit');
    Route::patch('/Analysis/update/{id}/{type}', 'AnalysController@update')->name('Analysis.update');
    Route::delete('/Analysis/delete/{id}', 'AnalysController@destroy')->name('Analysis.destroy');
    Route::get('/Analysis/deleteImageAll/{id}', 'AnalysController@deleteImageAll');
    Route::get('/Analysis/deleteImageEach/{id}/{type}/{fdate}/{tdate}/{branch}/{status}', 'AnalysController@deleteImageEach');
    Route::get('/Analysis/destroyImage/{id}/{type}/{fdate}/{tdate}/{branch}/{status}', 'AnalysController@destroyImage');

    Route::get('/Analysis/Report/{id}/{type}', 'ReportAnalysController@ReportPDFIndex');
    Route::get('/Analysis/ReportDueDate', 'ReportAnalysController@ReportDueDate');
    Route::get('/Analysis/ReportHomecar/{id}/{type}', 'ReportAnalysController@ReportHomecar');

    Route::get('/call/viewdetail/{Str1}/{Str2}', 'CallController@viewdetail')->name('callDetail.viewdetail');
    Route::get('/call/{type}', 'CallController@index')->name('call');
    Route::get('/Reportcall/{type}', 'ReportCallController@index')->name('reportcall');
    Route::get('/monthreport/{type}/{fmonth}/{fyear}', 'ReportCallController@monthReport')->name('monthreport');
    Route::get('/ReportCall/{type}', 'ReportCallController@update')->name('ReportCall.update');
    Route::get('/GroupCall/{type}', 'ReportCallController@updategroup')->name('updategroup');
    route::resource('ReportCall','ReportCallController');

    Route::get('/finance/{type}', 'FinanceController@index')->name('finance');

    Route::get('/ExportExcel/{type}', 'ExcelController@excel');

    Route::get('/Legislation/store/{Str1}/{Str2}/{Realty}', 'LegislationController@store')->name('legislation.store');
    Route::get('/Legislation/Home/{type}', 'LegislationController@index')->name('legislation');
    Route::get('/Legislation/edit/{id}/{type}', 'LegislationController@edit')->name('legislation.edit');
    Route::patch('/Legislation/update/{id}/{type}', 'LegislationController@update')->name('legislation.update');
    Route::delete('/Legislation/delete/{id}', 'LegislationController@destroy')->name('legislation.destroy');

    Route::get('/Precipitate/Home/{type}', 'PrecController@index')->name('Precipitate');
    Route::get('/Precipitate/ReportPrecDue', 'PrecController@ReportPrecDue');
    Route::get('/PrecipitateExcel', 'PrecController@excel');

//---------------- ยังไม่ใช้งาน --------------------//
    Route::get('/Report/Home/{type}', 'ReportController@index')->name('report');

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/{name}', 'HomeController@index')->name('index');

  });
