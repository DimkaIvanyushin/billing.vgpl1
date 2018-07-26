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


Route::get('/', [
    'uses' => 'EntryController@home',
    'as' => 'entry.home'
]);

/*

Teacher

*/

Route::get('/teacher', [
    'uses' => 'TeacherController@home',
    'as' => 'teacher.home'
]);

Route::get('/teacher/create', [
    'uses' => 'TeacherController@create',
    'as' => 'teacher.create'
]);

Route::get('/teacher/add', [
    'uses' => 'TeacherController@add',
    'as' => 'teacher.add'
]);

Route::get('/teacher/show/{id}', [
    'uses' => 'TeacherController@show',
    'as' => 'teacher.show'
]);

Route::get('/teacher/excel/{id}', [
    'uses' => 'TeacherController@print_excel'
]);

Route::get('/teacher/create/hour/{id}', [
    'uses' => 'TeacherController@create_hour',
    'as' => 'teacher.create_hour'
]);

Route::post('/teacher/hour/add_discipline', 'TeacherController@add_discipline');

Route::post('/teacher/hour/add', 'TeacherController@add_hour');
Route::post('/teacher/other_hour/add', 'TeacherController@add_other_hour');

Route::get('/teacher/edit/{id}', [
    'uses' => 'TeacherController@edit',
    'as' => 'teacher.edit'
])->where('id','[0-9]+');

Route::get('/teacher/sort/{name}/{sort}', 'TeacherController@sort')->where('sort', 'asc|desc');

Route::put('/teacher/edit', 'TeacherController@put');
Route::get('/teacher/delete/{id}', 'TeacherController@delete')->where('id','[0-9]+');
Route::post('/teacher/delete', 'TeacherController@delete_active');

Route::post('/teacher/discipline/delete', 'TeacherController@discipline_delete');
/*

Discipline

*/

Route::get('/discipline', [
    'uses' => 'DisciplineController@home',
    'as' => 'discipline.home'
]);

Route::get('/discipline/create', [
    'uses' => 'DisciplineController@create',
    'as' => 'discipline.create'
]);

Route::post('/discipline/add', [
    'uses' => 'DisciplineController@add',
    'as' => 'discipline.add'
]);

Route::get('/discipline/show/{id}', [
    'uses' => 'DisciplineController@show',
    'as' => 'discipline.show'
]);

Route::get('/discipline/edit/{id}', [
    'uses' => 'DisciplineController@edit',
    'as' => 'discipline.edit'
])->where('id','[0-9]+');


Route::put('/discipline/edit', 'DisciplineController@put');
Route::get('/discipline/delete/{id}', 'DisciplineController@delete')->where('id','[0-9]+');

/*

Group

*/

Route::get('/group', [
    'uses' => 'GroupController@home',
    'as' => 'group.home'
]);

Route::get('/group/create', [
    'uses' => 'GroupController@create',
    'as' => 'group.create'
]);

Route::post('/group/add', [
    'uses' => 'GroupController@add',
    'as' => 'group.add'
]);

Route::get('/group/edit/{id}', [
    'uses' => 'GroupController@edit',
    'as' => 'group.edit'
])->where('id','[0-9]+');


Route::put('/group/edit', 'GroupController@put');
Route::get('/group/delete/{id}', 'GroupController@delete')->where('id','[0-9]+');

/*
 *
 * Raspisanie
 *
 */

Route::get('/raspisanie', [
    'uses' => 'TimetableController@home',
    'as' => 'timetable.home'
]);
