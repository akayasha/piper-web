<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Branch extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'branches';
    protected $primaryKey = "id";

    protected $fillable = [
        'user_id',
        'name',
        'price',
        'phone',
        'address',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function redeemCode()
    {
        return $this->hasMany(RedeemCode::class, 'branch_id');
    }
}
