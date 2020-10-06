<?php

Route::group([
    'namespace'  => 'Bitfumes\Multiauth\Http\Controllers',
    'middleware' => 'web',
    'prefix'     => config('multiauth.prefix', 'admin'),
], function () {
    Route::GET('/home', 'AdminController@index')->name('admin.home');
    // Login and Logout
    Route::GET('/', 'LoginController@showLoginForm')->name('admin.login');
    Route::POST('/', 'LoginController@login');
    Route::POST('/logout', 'LoginController@logout')->name('admin.logout');

    // Password Resets
    Route::POST('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::GET('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::POST('/password/reset', 'ResetPasswordController@reset');
    Route::GET('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');

    // Register Admins
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'RegisterController@register');
    Route::get('/{admin}/edit', 'RegisterController@edit')->name('admin.edit');
    Route::delete('/{admin}', 'RegisterController@destroy')->name('admin.delete');
    Route::patch('/{admin}', 'RegisterController@update')->name('admin.update');

    // Admin Lists
    Route::get('/show', 'AdminController@show')->name('admin.show');

    // Admin Roles
    Route::post('/{admin}/role/{role}', 'AdminRoleController@attach')->name('admin.attach.roles');
    Route::delete('/{admin}/role/{role}', 'AdminRoleController@detach');

    // Roles
    Route::get('/roles', 'RoleController@index')->name('admin.roles');
    Route::get('/role/create', 'RoleController@create')->name('admin.role.create');
    Route::post('/role/store', 'RoleController@store')->name('admin.role.store');
    Route::delete('/role/{role}', 'RoleController@destroy')->name('admin.role.delete');
    Route::get('/role/{role}/edit', 'RoleController@edit')->name('admin.role.edit');
    Route::patch('/role/{role}', 'RoleController@update')->name('admin.role.update');




    ///////////////////////////
    ///////////////////////

});
Route::group([
    'namespace'  => 'App\Http\Controllers',
    'middleware' => 'web',
    'prefix'     => config('multiauth.prefix', 'admin'),
], function () {


  //Route::get('/','AdminController@index')->name('admin.index');
  Route::post('/updateSiteSettings','AdminSingleController@updateSiteSettings')->name('updateSiteSettings');
  Route::post('/updateAccount','AdminSingleController@updateAccount')->name('admin.updateAccount');
  //classes
  Route::resource('/classes','ClassesController');
  Route::post('/attachMatiere','ClassesController@attachMatiere')->name('classes.attachmatiere');
  Route::get('{class}/{matiere}/detach','ClassesController@detachMatiere')->name('classes.detachMatiere');
  Route::post('/createhMatiere','ClassesController@createAddMatiere')->name('classes.create_add_matiere');
  //matieres
  Route::resource('/matieres','MatiereController');


  Route::get('/export_excel','AdminSingleController@exportexcel')->name('export_excel.excel');
  Route::post('/import_excel','AdminSingleController@importexcel')->name('import_excel.excel');
  Route::get('/Supervisor','AdminSingleController@Supervisorpage')->name('admin.Supervisor');

});
//student activities
Route::group([
    'namespace'  => 'App\Http\Controllers',
    'middleware' => 'web',
    'prefix'     => config('multiauth.prefix', 'admin'),
], function () {

  //Route::get('/students','AdminSingleController@students')->name('admin.students');
  Route::get('/new_students','AdminSingleController@new_students')->name('admin.new_students');
  Route::get('students/{student_id}/activate','AdminSingleController@activateAccount')->name('student.activate_account');
  Route::post('/students/add_to_class','AdminSingleController@addToClass')->name('students.add_to_class');
  Route::post('/students/add_absence','AdminSingleController@addAbsence')->name('students.add_absence');
  Route::get('/students/{student_id}/marks','AdminSingleController@Marks')->name('students.marks');
  Route::post('/students/{student_id}/marks/update','AdminSingleController@updateMarks')->name('students.update_marks');
});