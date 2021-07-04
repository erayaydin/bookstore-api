<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PublisherController;
use App\Models\Category;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** @var $route Router */

try {
    $route = app()->make('router');
} catch (BindingResolutionException $e) {
    abort(500);
}

$route->model('category', Category::class);

$route->group(['middleware' => ['guest:sanctum']], function(Router $route) {
    $route->post('/auth/token', [AuthController::class, 'getToken'])->name('auth.token');
    $route->post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
});

$route->group(['middleware' => ['auth:sanctum']], function(Router $route) {
    $route->get('me', [AuthController::class, 'me'])->name('me');

    $route->get('category', [CategoryController::class, 'index'])->name('category.index');
    $route->get('category/{category}', [CategoryController::class, 'show'])->name('category.show');

    $route->get('book', [BookController::class, 'index'])->name('book.index');
    $route->get('book/{book}', [BookController::class, 'show'])->name('book.show');
    $route->get('book/{book}/file', [BookController::class, 'getFile'])->name('book.get-file');

    $route->get('publisher', [PublisherController::class, 'index'])->name('publisher.index');
    $route->get('publisher/{publisher}', [PublisherController::class, 'show'])->name('publisher.show');
});
