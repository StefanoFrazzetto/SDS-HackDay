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

Route::get('/adzuna/job', 'AdzunaController@countJobs');
Route::get('/adzuna/job/{job}', 'AdzunaController@countJobs');
Route::get('/adzuna/county/{county}', 'AdzunaController@countJobs');

Route::get('/adzuna/county/{county}', 'AdzunaController@countAllJobsByCounty');
Route::get('/adzuna/job/{job}/county/{county}', 'AdzunaController@countJobs');

Route::get('/adzuna/locate/job/{job}/county/{county}', 'AdzunaController@getJobs');
Route::get('/adzuna/locate/county/{county}/job/{job}', 'AdzunaController@getJobs');

Route::get('/adzuna/categories', 'AdzunaController@getJobCategories');
Route::get('/adzuna/companies', 'AdzunaController@getTopCompanies');
Route::get('/adzuna/companies/{county}', 'AdzunaController@getTopCompanies');