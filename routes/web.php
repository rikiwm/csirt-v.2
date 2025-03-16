<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\StaticController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/test', [HomeController::class, 'test'])->name('test');
// Route::prefix('/')->group(function () {
//     Route::get('/faq', [StaticController::class, 'faq'])->name('faq');
// });
Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('webTrackVisitors');
    Route::get('/{slug}', [HomeController::class, 'show'])->name('show');
    Route::get('/post/{slug}', [ListController::class, 'list'])->name('post.detail')->middleware('postTrackVisitors');
    Route::get('/app/summary-report/print', [StaticController::class, 'print'])->name('summary-report.print');
});

