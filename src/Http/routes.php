<?php

use DagaSmart\Gateway\Http\Controllers;
use Illuminate\Support\Facades\Route;
use DagaSmart\BizAdmin\Middleware\Permission;
use DagaSmart\BizAdmin\Middleware\Authenticate;


Route::get('gateway', [Controllers\GatewayController::class, 'index']);

//免登录无限制
//Route::get('gateway', [Controllers\GatewayController::class, 'index'])->withoutMiddleware([Authenticate::class, Permission::class]);
