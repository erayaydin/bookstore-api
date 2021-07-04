<?php

/** @var $route Router */

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookSectionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublisherController;
use App\Models\BookSection;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Routing\Router;

try {
    $route = app()->make('router');
} catch (BindingResolutionException $e) {
    abort(500);
}

$route->model('section', BookSection::class);

// Auth Only
$route->group(['middleware' => ['auth', 'auth.back-office']], function (Router $route) {
    $route->get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // Auth routes
    $route->group(['as' => 'auth.'], function (Router $route) {
        $route->get('logout', [AuthController::class, 'logout'])->name('logout');
    });

    $route->resource('category', CategoryController::class, ['except' => ['show']]);
    $route->resource('publisher', PublisherController::class, ['except' => ['show']]);
    $route->resource('author', AuthorController::class, ['except' => ['show']]);
    $route->resource('book', BookController::class, ['except' => ['show']]);
    $route->get('book/{book}/download', [BookController::class, 'download'])->name('book.download');
    $route->resource('book.section', BookSectionController::class, ['except' => ['show']]);
});

// Guest Only
$route->group(['middleware' => ['guest']], function (Router $route) {

    // Auth routes
    $route->group(['as' => 'auth.'], function (Router $route) {
        $route->get('login', [AuthController::class, 'login'])->name('login');
        $route->post('login', [AuthController::class, 'doLogin'])->name('do-login');
    });

});
