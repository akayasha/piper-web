<?php

namespace App\Helpers;

use App\Models\RedeemCode;

trait GenerateCodeAuto {

    public function generateUniqueRedeemCode($length = 5)
    {
        do {
            $numbers = [];
            for ($i = 0; $i < $length; $i++) {
                $numbers[] = rand(0, 9);
            }
            $code = implode('', $numbers);
        } while (RedeemCode::where('code', $code)->where('is_redeemed', true)->exists());

        return $code;
    }
}
