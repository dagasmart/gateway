<?php

namespace DagaSmart\Gateway\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;

class GatewayController extends AdminController
{
    public function index(): JsonResponse|JsonResource
    {
        $page = $this->basePage()->body('Gateway Extension.');

        return $this->response()->success($page);
    }
}
