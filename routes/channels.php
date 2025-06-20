<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Payment;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('payment-status.{invoiceNumber}', function ($user, $invoiceNumber) {
    $payment = Payment::where('invoice_number', $invoiceNumber)->first();

    if (!$payment) {
        return false;
    }

    return $payment->user_id === $user->id;
});
