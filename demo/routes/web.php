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
Route::group(['middleware' => 'preventBackHistory'],function(){
	Route::get('/', 'HomeController@welcome')->name('welcome');
	Route::get('admin','Admin\Auth\LoginController@showLoginForm')->name('admin.showLoginForm');
	Route::get('admin/login','Admin\Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('admin/login', 'Admin\Auth\LoginController@login');
	Route::get('admin/resetPassword','Admin\Auth\PasswordResetController@showPasswordRest')->name('admin.resetPassword');
	Route::post('admin/sendResetLinkEmail', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.sendResetLinkEmail');
	Route::get('admin/find/{token}', 'Admin\Auth\PasswordResetController@find')->name('admin.find');
	Route::post('admin/create', 'Admin\Auth\PasswordResetController@create')->name('admin.sendLinkToUser');
	Route::post('admin/reset', 'Admin\Auth\PasswordResetController@reset')->name('admin.resetPassword_set');
	Route::group(['prefix' => 'admin','middleware'=>'Admin','namespace' => 'Admin','as' => 'admin.'],function(){
		Route::get('/dashboard','MainController@dashboard')->name('dashboard');
		Route::post('/acceptTransaction/{id}','MainController@acceptTransaction')->name('acceptTransaction');
		Route::post('/destroyTransaction/{id}','MainController@destroyTransaction')->name('destroyTransaction');
		Route::post('/filter_by','MainController@dashboard')->name('filter_by');
		Route::get('/logout','Auth\LoginController@logout')->name('logout');

		//====================> Update Admin Profile =========================
		Route::get('/profile','UsersController@updateProfile')->name('profile');
		Route::post('/updateProfileDetail','UsersController@updateProfileDetail')->name('updateProfileDetail');
		Route::post('/updatePassword','UsersController@updatePassword')->name('updatePassword');

		//====================> Branches Management =========================
		Route::get('/branches','BranchesController@index')->name('branches.index');
		Route::get('/branches/create','BranchesController@create')->name('branches.create');
		Route::post('/branches/store','BranchesController@store')->name('branches.store');
		Route::get('/branches/edit/{id}','BranchesController@edit')->name('branches.edit');
		Route::post('/branches/update/{id}','BranchesController@update')->name('branches.update');
		Route::post('/branches/delete/{id}','BranchesController@delete')->name('branches.delete');
		Route::post('/branches/change_status','BranchesController@change_status')->name('branches.change_status');
		Route::get('/branches/show','BranchesController@show')->name('branches.show');
		Route::post('/branches/updatebalance/{id}','BranchesController@updatebalance')->name('branches.updatebalance');

		//====================> Transactions Management =========================
		Route::get('/transactions','TransactionsController@index')->name('transactions.index');
		Route::get('/transactions/create','TransactionsController@create')->name('transactions.create');
		Route::post('/transactions/store','TransactionsController@store')->name('transactions.store');
		Route::post('/transactions/delete/{id}','TransactionsController@delete')->name('transactions.delete');
		Route::post('/transactions','TransactionsController@index')->name('transactions.filter_by');
		Route::post('/transactions/get_form_user','TransactionsController@get_form_user')->name('transactions.get_form_user');

		//====================> General Management =========================
		Route::get('/generalreports','GeneralreportsController@index')->name('generalreports.index');

		//====================> Branches Report Management =========================
		Route::get('/branchreports','BranchreportsController@index')->name('branchreports.index');
		Route::post('/branchreports/report','BranchreportsController@index')->name('branchreports.report');

		//====================> Expenses Types Management =========================
		Route::get('/expensetype','ExpensesTypesController@index')->name('expensetype.index');
		Route::get('/expensetype/create','ExpensesTypesController@create')->name('expensetype.create');
		Route::post('/expensetype/store','ExpensesTypesController@store')->name('expensetype.store');
		Route::get('/expensetype/edit/{id}','ExpensesTypesController@edit')->name('expensetype.edit');
		Route::post('/expensetype/update/{id}','ExpensesTypesController@update')->name('expensetype.update');
		Route::post('/expensetype/delete/{id}','ExpensesTypesController@delete')->name('expensetype.delete');

		//====================> Expenses Management =========================
		Route::get('/expenses','ExpensesController@index')->name('expenses.index');
		Route::get('/expenses/create','ExpensesController@create')->name('expenses.create');
		Route::post('/expenses/store','ExpensesController@store')->name('expenses.store');
		Route::get('/expenses/edit/{id}','ExpensesController@edit')->name('expenses.edit');
		Route::post('/expenses/update/{id}','ExpensesController@update')->name('expenses.update');
		Route::post('/expenses/delete/{id}','ExpensesController@delete')->name('expenses.delete');
		Route::post('/expenses/filter_by','ExpensesController@index')->name('expenses.filter_by');

		//====================> Setting Management =========================
		Route::get('/setting','SettingsController@index')->name('setting.index');
		Route::get('/setting/edit/{id}','SettingsController@edit')->name('setting.edit');
		Route::post('/setting/update/{id}','SettingsController@update')->name('setting.update');
		Route::post('/setting/change_status','SettingsController@change_status')->name('setting.change_status');
	});
});