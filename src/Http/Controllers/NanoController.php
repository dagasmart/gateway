<?php

namespace DagaSmart\Gateway\Http\Controllers;

use DagaSmart\BizAdmin\Renderers\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DagaSmart\Gateway\Services\NanoService;


class NanoController extends AdminController
{
    protected string $serviceName = NanoService::class;

    /**
     * NanoMQ 客户端鉴权
     * - NanoMQ 会把 username / password 以 form 形式 POST 过来
     * - Hash::make('123456')
     */
    public function auth(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $clientid = $request->input('clientid', '');
        $ipaddr   = $request->input('ipaddr', $request->ip());

        // 查询用户表（按你的实际表结构调整）
        $user = $this->service->auth($username, $password, $clientid, $ipaddr);
        // 密码校验：推荐用 password_hash() 存储
        if ($user) {
            return $this->response()->success([
                'result' => 'allow',
                // 可选：返回 ACL 规则
                'acl' => [
                    ['permission' => 'allow', 'action' => 'publish',   'topic' => "device/{$user->username}/#"],
                    ['permission' => 'allow', 'action' => 'subscribe', 'topic' => "device/{$user->username}/#"],
                ],
            ]);
        }

        return $this->response()->fail('认证失败', ['result' => 'deny']);
    }
}
