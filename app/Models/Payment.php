<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'payments';
    protected $primaryKey = "id";
    
    protected $fillable = [
        'id',
        'redeem_code_id',
        'invoice_number',
        'transaction_id',
        'price',
        'strip',
        'status',
        'payment_method',
    ];

    public function redeemCode()
    {
        return $this->belongsTo(RedeemCode::class, 'redeem_code_id');
    }
}
