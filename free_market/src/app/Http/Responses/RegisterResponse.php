<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    
    public function toResponse($request)
    {
        // プロフィール設定画面のパスやルート名を指定
        return redirect()->route('editProfile'); 
    }
        
}