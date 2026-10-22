<?php

use DagaSmart\Gateway\Http\Controllers;
use DagaSmart\Gateway\Http\Middleware;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use DagaSmart\BizAdmin\Middleware\Authenticate;
use DagaSmart\BizAdmin\Middleware\Permission;

// 需登录与鉴权
Route::group([
    'prefix' => 'extension',
    'middleware' => [
        Middleware\Middleware::class,
    ],
], function (Router $router) {
    Route::get('gateway', [Controllers\GatewayController::class, 'index']);

    Route::post('gateway/nano/auth', [Controllers\NanoController::class, 'auth'])
        ->withoutMiddleware([Permission::class])
        ->withoutMiddleware([Authenticate::class]);
    Route::post('gateway/mqtt/auth', [Controllers\MqttController::class, 'auth']);

    // resource必须放最后面
    $router->resource('gateway/mqtt/index', Controllers\MqttController::class);
    $router->resource('gateway/nano/index', Controllers\NanoController::class);
});

// 免登录无限制
// Route::get('official', [Controllers\OfficialController::class, 'index'])->withoutMiddleware([Authenticate::class, Permission::class]);


