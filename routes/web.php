<?php

use App\Http\Controllers\PageCourseDetailsController;
use App\Http\Controllers\PageHomeController;
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

Route::get('/', PageHomeController::class)->name('home');

Route::get('courses/{course:slug}', PageCourseDetailsController::class)->name('course-details');
