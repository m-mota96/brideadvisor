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

Route::get('/', 'PublicController@index');

Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/bride-mag', 'PublicController@brideMag')->name('bride.mag');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/proveedores', function () {
    return view('public.provider');
})->name('proveedores');

// Group Route for admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/usuarios', 'UserController@users')->name('usuarios');
    Route::get('/eventos', 'EventController@events')->name('eventos');
    Route::get('/recintos', 'EventController@enclosures')->name('recintos');
    Route::get('/expositores', 'ExhibitorsController@exhibitors')->name('expositores');
    Route::get('/staff', 'ExhibitorsController@staff')->name('staff');
    Route::get('/nuevoproveedor', 'ExhibitorsController@newprovider')->name('nuevoproveedor');
    Route::get('/galeria/{id}', 'ExhibitorsController@gallery')->name('galeria');
});

// Group Route for customer
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['role:customer']], function () {
        Route::get('register/customer', function () {
            return view('auth.registerCustomer');
        })->name('register.customer');

        Route::get('customer/checklist', 'TaskController@checklist')->name('customer.checklist');
        Route::get('customer/expense', 'ExpenseController@expense')->name('customer.expense');

        Route::get('customer/invitation', 'InvitationController@index')->name('customer.invitation');

        Route::post('register/customer/complete', 'CustomerController@completeRegister')->name('complete.customer');
        Route::post('saveTask', 'TaskController@saveTask')->name('saveTask');
        Route::post('saveBudget', 'TaskController@saveBudget');
        Route::post('task/store', 'TaskController@store')->name('task.store');
        Route::post('expense/store', 'ExpenseController@store')->name('expense.store');
        Route::post('saveExpense', 'ExpenseController@saveExpense')->name('saveExpense');
        Route::post('create_table', 'InvitationController@createTable')->name('create.table');
        Route::post('/add_guest', 'InvitationController@addGuest')->name('add.guest');
    });
});

Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('login');
Route::get('provider/home', 'HomeController@providerHome')->name('provider.home')->middleware('verified');
Route::get('customer/home', 'HomeController@customerHome')->name('customer.home')->middleware('login');

// Formulario Registro Customer

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

//Group Route for Bride Weekend
Route::prefix('brideweekend')->name('brideweekend')->group(function() {
    Route::get('/', 'BrideWeekendController@index');
    Route::get('/expositor', 'BrideWeekendController@exhibitor')->name('/expositor');
    Route::get('/concepto', 'BrideWeekendController@concept')->name('/concepto');
    Route::get('/ciudades', 'BrideWeekendController@cities')->name('/ciudades');
    Route::get('/ciudad/{id}', 'BrideWeekendController@city')->name('/ciudad');
    Route::get('/carrera', 'BrideWeekendController@carrera')->name('/carrera');
    Route::get('/regalos', 'BrideWeekendController@gifts')->name('/regalos');
    Route::get('/expositores/{id}', 'BrideWeekendController@exhibitors')->name('/expositores');
});

//Group Route for Provider
Route::prefix('provider')->name('provider.')->middleware(['auth', 'role:provider', 'verified'])->group(function() {
    Route::get('/escaparate', 'ShowCaseController@index')->name('escaparate');
    Route::get('/localizacion', 'ShowCaseController@location')->name('localizacion');
    Route::get('/fotos', 'ShowCaseController@photos')->name('fotos');
    Route::get('/recomendaciones', 'ShowCaseController@recomendations')->name('recomendaciones');
    Route::get('/estadisticas', 'ShowCaseController@stats')->name('estadisticas');
    Route::get('/cuenta', 'ShowCaseController@account')->name('cuenta');
    Route::get('/pagos', 'ShowCaseController@payments')->name('pagos');
    Route::get('/promociones', 'ShowCaseController@promotions')->name('promociones');
});

//Routes usage for provider
Route::post('checkPassword', 'ShowCaseController@checkPassword');
Route::post('updateCredentials', 'ShowCaseController@updateCredentials');
Route::get('extractLocation', 'ShowCaseController@extractLocation');
Route::post('updateContact', 'ShowCaseController@updateContact');
Route::post('updateInfo', 'ShowCaseController@updateInfo');
Route::post('updatePrices', 'ShowCaseController@updatePrices');
Route::post('updateAddress', 'ShowCaseController@updateAddress');
Route::post('uploadImages', 'ShowCaseController@uploadImages');
Route::post('checkVideo', 'ShowCaseController@checkVideo');
Route::post('uploadVideo', 'ShowCaseController@uploadVideo');
Route::post('deleteGalleryProvider', 'ShowCaseController@deleteGalleryProvider');
Route::post('profileOrLogotype', 'ShowCaseController@profileOrLogotype');
Route::get('extractStatistic', 'ShowCaseController@extractStatistic');
Route::post('createPromotion', 'ShowCaseController@createPromotion');

//Routes usage for admin
Route::get('extractUsers', 'UserController@extractUsers');
Route::post('updateUser', 'UserController@updateUser');
Route::post('createEvent', 'EventController@createEvent')->name('createEvent');
Route::get('extractEvents', 'EventController@extractEvents');
Route::post('updateStatusEvent', 'EventController@updateStatusEvent');
Route::get('extractEnclosures', 'EventController@extractEnclosures');
Route::post('createEnclosure', 'EventController@createEnclosure')->name('createEnclosure');
Route::post('deleteEnclosure', 'EventController@deleteEnclosure');
Route::get('extractProviders', 'ExhibitorsController@extractProviders');
Route::post('assignProviderToEvent', 'ExhibitorsController@assignProviderToEvent');
Route::get('extractProvidersAssigned', 'ExhibitorsController@extractProvidersAssigned');
Route::post('updateQuantityStaff', 'ExhibitorsController@updateQuantityStaff');
Route::post('sendLinkStaff', 'ExhibitorsController@sendLinkStaff');
Route::post('createProvider', 'ExhibitorsController@createProvider');
Route::post('updateStatusUser', 'ExhibitorsController@updateStatusUser');
Route::get('extractCity', 'ExhibitorsController@extractCity');
Route::post('saveNewCity', 'ExhibitorsController@saveNewCity');
Route::get('extractCategories', 'ExhibitorsController@extractCategories');
Route::post('updateCategory', 'ExhibitorsController@updateCategory');

Route::get('/proveedores', 'ProviderController@index')->name('proveedores');
Route::get('/proveedor/{slug}', 'ProviderController@provider')->name('proveedor');
Route::post('/filterForCategory', 'ProviderController@filterForCategory');
Route::post('/saveQualification', 'ProviderController@saveQualification');
Route::get('autocompleteProviders', 'ProviderController@autocompleteProviders');
Route::post('searchWord', 'ProviderController@searchWord');
Route::get('/bridestore', 'BrideStoreController@index')->name('bridestore');
Route::get('/promocion/{id}', 'BrideStoreController@promotion')->name('promocion');
Route::post('saveSchedules', 'BrideStoreController@saveSchedules');
Route::post('checkSchedules', 'BrideStoreController@checkSchedules');
Route::post('makePayment', 'BrideStoreController@makePayment');
Route::post('filterPromotions', 'BrideStoreController@filterPromotions');