<?php

namespace App\Helpers;

use App\Models\RedeemCode;

trait GenerateCodeAuto {

    public function generateUniqueRedeemCode($length = 5)
    {
        do {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
        } while (RedeemCode::where('code', $code)->where('is_redeemed', true)->exists());

        return $code;
    }
}
