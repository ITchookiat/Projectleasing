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
    return view('welcome');
    // return redirect('/home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function()
  {
    //----------------Admin register-----------------//
    route::resource('MasterMaindata','UserController');

    route::resource('MasterAnalysis','AnalysController');
    Route::get('/Analysis/Home/{type}', 'AnalysController@index')->name('Analysis');
    Route::get('/Analysis/edit/{type}/{id}/{fdate}/{tdate}/{status}', 'AnalysController@edit')->name('Analysis.edit');
    Route::patch('/Analysis/update/{id}/{type}', 'AnalysController@update')->name('Analysis.update');
    Route::patch('/Analysis/updaterestructure/{id}/{Gettype}', 'AnalysController@updaterestructure');
    Route::patch('/Analysis/updatehomecar/{id}/{Gettype}', 'AnalysController@updatehomecar');
    Route::delete('/Analysis/delete/{id}/{type}', 'AnalysController@destroy')->name('Analysis.destroy');
    Route::get('/Analysis/ReportHomecar/{id}/{type}', 'ReportAnalysController@ReportHomecar');
    
    // ใช้ร่วมกับ แผนกอื่นๆ //
    Route::get('/Analysis/deleteImageAll/{id}/{path}', 'AnalysController@deleteImageAll');
    Route::get('/Analysis/destroyImage/{id}/{type}/{fdate}/{tdate}/{status}/{path}', 'AnalysController@destroyImage');
    Route::get('/Analysis/deleteImageEach/{type}/{id}/{fdate}/{tdate}/{status}/{path}', 'AnalysController@deleteImageEach')->name('deleteImageEach');
    Route::get('/Analysis/Report/{id}/{type}', 'ReportAnalysController@ReportPDFIndex');
    Route::get('/Analysis/ReportDueDate/{type}', 'ReportAnalysController@ReportDueDate');
    //-------------------//-----------//
    
    Route::get('/ExportExcel/{type}', 'ExcelController@excel');

    //------------------งานกฏหมาย--------------------//
    route::resource('MasterLegis','LegislationController');
    Route::get('/Legislation/Savestore', 'LegislationController@Savestore')->name('legislation.Savestore');
    Route::post('/Legislation/SearchData/{type}', 'LegislationController@SearchData')->name('legislation.SearchData');
    Route::get('/Legislation/deleteImageAll/{id}', 'LegislationController@deleteImageAll');
    Route::get('/Legislation/Report/{id}/{type}', 'LegislationController@ReportReceipt')->name('legislation.report');

    route::resource('MasterCompro','LegisComproController');
    Route::get('/LegisCompro/report/{type}', 'LegisComproController@ReportCompro')->name('LegisCompro.ReportCompro');

    //------------------งานเร่งรัด----------------------//
    route::resource('MasterPrecipitate','PrecController');
    Route::get('/Precipitate/Home/{type}', 'PrecController@index')->name('Precipitate');
    Route::get('/PrecipitateExcel', 'PrecController@excel');
    Route::get('/Precipitate/ReportPrecDue/{Str1}/{Str2}', 'PrecController@ReportPrecDue');
    Route::get('/Precipitate/DebtEdit/{type}/{id}/{fdate}/{tdate}/{branch}/{status}', 'PrecController@DebtEdit')->name('Precipitate.DebtEdit');
    Route::get('/Precipitate/report/{type}', 'PrecController@ReportLetter')->name('Precipitate.report');

    //------------------งานการเงิน---------------------//
    route::resource('MasterTreasury','TreasController');
    Route::get('/Treasury/Home/{type}', 'TreasController@index')->name('treasury');
    Route::get('/Treasury/SearchData/{type}/{id}', 'TreasController@SearchData')->name('SearchData');
    Route::get('/Treasury/ReportDueDate/{type}', 'TreasController@ReportDueDate')->name('treasury.ReportDueDate');

    //------------------งานบัญชี----------------------//
    Route::get('/Account/Home/{type}', 'AccountController@index')->name('Accounting');

    //------------------งานทะเบียน--------------------//
    route::resource('MasterRegister','RegisterController');
    Route::get('/Register/Home/{type}', 'RegisterController@index')->name('Register');

    //------------------ลูกค้า walkin------------------//
    route::resource('MasterDataCustomer','DataCustomerController');
    Route::get('/DataCustomer/Home/{type}', 'DataCustomerController@index')->name('DataCustomer');
    Route::get('/DataCustomer/Savestatus/{value}/{id}', 'DataCustomerController@savestatus')->name('DataCustomer.savestatus');

    //------------------LOCKER เอกสาร-----------------//
    route::resource('MasterDocument','DocumentController');
    Route::get('/Document/Home/{type}', 'DocumentController@index')->name('document');
    Route::get('/Document/download/{file}', 'DocumentController@download');

    //------------------Infomation-----------------//
    route::resource('MasterInfo','InfoController');
    Route::get('/MasterInfo/ShowInfo/{type}/{id}', 'InfoController@ShowInfo')->name('ShowInfo');

     //------------------Events-----------------//
    route::resource('MasterEvents','EventController');
    Route::get('/MasterEvents/ShowEvent/{type}', 'EventController@ShowEvent')->name('Events.ShowEvent');
    Route::get('/MasterEvents/DeleteEvents/{id}/{path}/{type}', 'EventController@DeleteEvents');

    //---------------- logout --------------------//
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/{name}', 'HomeController@index')->name('index');

  });
