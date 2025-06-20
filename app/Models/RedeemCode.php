<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;


class RedeemCode extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'redeem_codes';
    protected $primaryKey = "id";

    protected $fillable = [
        'branch_id',
        'code',
        'type',
        'strip',
        'is_redeemed',
        'redeemed_at',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, 'redeem_code_id');
    }
}
