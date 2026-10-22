<?php

namespace DagaSmart\Gateway\Services;

use DagaSmart\Gateway\Models\GatewayUser;
use DagaSmart\Gateway\Models\Nano;
use Illuminate\Support\Facades\Hash;

/**
 * Nano-服务类
 */
class NanoService extends AdminService
{
    protected string $modelName = Nano::class;

    /**
     * 用户认证
     */
    public function auth($username, $password, $clientid = null, $ipaddr = null): ?GatewayUser
    {
        // 查询用户表（按你的实际表结构调整）
        $user = GatewayUser::query()
            ->where('username', $username)
            ->where('active', true)
            ->first();

        // 密码校验：推荐用 password_hash() 存储
        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }

        return $user;
    }
}
