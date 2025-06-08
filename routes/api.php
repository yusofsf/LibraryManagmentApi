<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\PenaltyController;
use App\Http\Controllers\Api\PublicationController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\StatsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->middleware('throttle:10,1')
    ->controller(AuthController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::get('/logout', 'logout')->middleware('auth:sanctum');
    });

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/{user}', 'show');
        Route::delete('/users/{user}', 'delete');
        Route::patch('/users/{user}', 'update');
    });

    Route::controller(ReservationController::class)->group(function () {
        Route::get('/reservations', 'index');
        Route::post('/reservations/books/{book}', 'store');
        Route::get('/reservations/{reservation}', 'show');
        Route::delete('/reservations/{reservation}', 'delete');
        Route::post('/reservations/{reservation}/books/{book}', 'withdrawal');
        Route::patch('/reservations/{reservation}/books/{book}', 'update');
    });

    Route::controller(PublicationController::class)->group(function () {
        Route::get('/publication', 'index');
        Route::get('/publications/{publication}', 'show');
        Route::post('/publications', 'store');
        Route::patch('/publications/{publication}', 'update');
        Route::delete('/publications/{publication}', 'delete');
        Route::post('/publications/{publication}/books', 'storeBook');

    });

    Route::controller(BookController::class)->group(function () {
        Route::get('/books', 'index');
        Route::delete('/books/{book}', 'delete');
        Route::patch('/books/{book}', 'update');
        Route::get('/books/{book}', 'show');
    });

    Route::controller(PenaltyController::class)->group(function () {
        Route::get('/penalties', 'index');
        Route::delete('/penalties/{penalty}', 'delete');
        Route::patch('/penalties/{penalty}', 'update');
        Route::get('/penalties/{penalty}', 'show');
    });

    Route::controller(StatsController::class)->group(function () {
        Route::get('/stats/lent-books', 'lentBooks');
        Route::get('/stats/available-books', 'availableBooks');
        Route::get('/stats/penalties', 'penalties');
        Route::get('/stats/most-lent-books', 'mostLentBooks');
        Route::get('/stats/most-active-users', 'mostActiveUsers');
        Route::get('/stats/pdf', 'statsToPDF');
    });

    Route::controller(SearchController::class)->group(function () {
        Route::get('/search-books', 'searchBooks');
        Route::get('/search-publications', 'searchPublications');
        Route::get('/search-reservations', 'searchReservations');
    });
});

