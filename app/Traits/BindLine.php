<?php

namespace App\Traits;

use App\Models\SocialiteOauth;
use Illuminate\Support\Facades\Auth;

trait BindLine
{
    use ApiResponse;

    protected function providerBindLine($provider, $oauthId)
    {
        $socialiteOauth = SocialiteOauth::query()
            ->where('oauth_id', $oauthId)
            ->where("oauth_type", "line")
            ->where("provider", $provider)
            ->first();
        if (!$socialiteOauth) {
            return $this->forbidden("非法请求");
        }

        if (!$socialiteOauth) {
            return $this->forbidden("当前账号已绑定，请勿重复绑定");
        }

        $socialiteOauth->user_id = Auth::id();
        $socialiteOauth->save();

        return $this->noContent();
    }
}
