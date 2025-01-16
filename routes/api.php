<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;


Route::get('/articles', [ArticleController::class, 'fetchArticles']);
Route::post('/update-articles', [ArticleController::class, 'updateArticles']);
