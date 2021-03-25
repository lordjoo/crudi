<?php


use Illuminate\Support\Facades\Route;

if (!Route::hasMacro("crudi")){
    Route::macro('crudi',function ($prefix, $as, $controller, $middleware = 'web') {
        Route::group([
            'prefix'=>$prefix,
            "as"=>$as.'.',
            "middleware"=>$middleware,
        ],function () use ($controller) {
            Route::get('/',[$controller,'all'])->name('all');
            Route::get('/create',[$controller,'create'])->name('create');
            Route::post('/create',[$controller,'store'])->name('store');
            Route::get('/update/{id?}',[$controller,'edit'])->name('edit');
            Route::post('/update/{id?}',[$controller,'update'])->name('update');
            Route::get('/delete/{id?}',[$controller,'delete'])->name('delete');
        });
    });
}
