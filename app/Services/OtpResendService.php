<?php

namespace App\Services;

use App\Models\User;
use App\Models\Otp;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpEmail;
use Carbon\Carbon;

class OtpResendService
{
    public function resendOtp(User $user)
    {
        $otpRecord = Otp::where('user_id', $user->id)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($otpRecord) {
            $otpRecord->update([
                'expires_at' => Carbon::now(),
            ]);
        }

        $otp = Otp::generateNumericOtp();
        $expiresAt = Carbon::now()->addMinutes(3);

        Otp::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ]);

        // Send the OTP via email
        Mail::to($user->email)->send(new OtpEmail($otp));

        return response()->json([
            'message' => 'OTP resent successfully.',
        ], 200);
    }
}
