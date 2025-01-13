<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\UserController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\FileUploadController;
use App\Http\Controllers\API\V1\MaterialController;
use App\Http\Controllers\API\V1\PaymentController;
use App\Http\Controllers\API\V1\SubjectController;
use App\Http\Controllers\API\V1\SubscriptionController;
use App\Http\Controllers\API\V1\SubscriptionHistoryController;
use App\Http\Controllers\Home\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('v1/auth/login', [AuthController::class, 'loginWithLogin']);
Route::post('v2/auth/login', [AuthController::class, 'loginWithPhone']);
Route::post('v3/auth/login', [AuthController::class, 'loginWithEmail']);
Route::post('file', [MaterialController::class, 'readPdfAndReadWordPages']);


Route::controller(HomeController::class)
    // ->middleware('basicAuth')
    ->prefix('v1')
    ->group(function () {
        Route::get('/category', 'categories');
        Route::get('/subject', 'subjects');
    });

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)
        ->group(function () {
            Route::get('auth/me', 'me');
            Route::get('auth/logout', 'logout');
        });

        Route::controller(UserController::class)
            // ->middleware('basicAuth')
            ->group(function () {
                Route::get('/user/index', 'index');
                Route::get('/user/for/options', 'forOptions');
                Route::get('/user/view/{id}', 'view');
                Route::post('/user/store', 'store');
                Route::put('/user/update/{id}', 'update');
                Route::delete('/user/delete/{id}', 'destroy');
            });
        
        Route::controller(CategoryController::class)
            // ->middleware('basicAuth')
            ->group(function () {
                Route::get('/category/index', 'index');
                Route::get('/category/for/options', 'forOptions');
                Route::get('/category/view/{id}', 'view');
                Route::post('/category/store', 'store');
                Route::put('/category/update/{id}', 'update');
                Route::delete('/category/delete/{id}', 'destroy');
            });
        
        Route::controller(SubjectController::class)
            // ->middleware('basicAuth')
            ->group(function () {
                Route::get('/subject/index', 'index');
                Route::get('/subject/for/options', 'forOptions');
                Route::get('/subject/view/{id}', 'view');
                Route::post('/subject/store', 'store');
                Route::put('/subject/update/{id}', 'update');
                Route::delete('/subject/delete/{id}', 'destroy');
            });
        
        Route::controller(PaymentController::class)
            // ->middleware('basicAuth')
            ->group(function () {
                Route::get('/payment/index', 'index');
                Route::get('/payment/for/options', 'forOptions');
                Route::get('/payment/view/{id}', 'view');
                Route::post('/payment/store', 'store');
                Route::put('/payment/update/{id}', 'update');
                Route::delete('/payment/delete/{id}', 'destroy');
            });
        
        Route::controller(SubscriptionController::class)
            // ->middleware('basicAuth')
            ->group(function () {
                Route::get('/subscription/index', 'index');
                Route::get('/subscription/for/options', 'forOptions');
                Route::get('/subscription/view/{id}', 'view');
                Route::post('/subscription/store', 'store');
                Route::put('/subscription/update/{id}', 'update');
                Route::delete('/subscription/delete/{id}', 'destroy');
            });
        
        Route::controller(SubscriptionHistoryController::class)
            // ->middleware('basicAuth')
            ->group(function () {
                Route::get('/history/subscription/index', 'index');
                Route::get('/history/subscription/for/options', 'forOptions');
                Route::get('/history/subscription/view/{id}', 'view');
                Route::post('/history/subscription/store', 'store');
                Route::put('/history/subscription/update/{id}', 'update');
                Route::delete('/history/subscription/delete/{id}', 'destroy');
            });
        
        Route::controller(MaterialController::class)
            // ->middleware('basicAuth')
            ->group(function () {
                Route::get('/material/index', 'index');
                Route::get('/material/for/options', 'forOptions');
                Route::get('/material/view/{id}', 'view');
                Route::post('/material/store', 'store');
                Route::post('/material/uploaded', 'readPdfAndReadWordPages');
                Route::put('/material/update/{id}', 'update');
                Route::delete('/material/delete/{id}', 'destroy');
            });
    });


    





    