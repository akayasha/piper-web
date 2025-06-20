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
        'name',
        'phone',
        'address',
        // 'price',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function redeemCodes()
    {
        return $this->hasMany(RedeemCode::class, 'branch_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'branch_id', 'id');
    }
    
    public function priceBranches()
    {
        return $this->hasMany(PriceBranch::class, 'branch_id', 'id');
    }


    // public function priceBranches()
    // {
    //     return $this->hasMany(PriceBranch::class, 'branch_id', 'id');
    // }

}
