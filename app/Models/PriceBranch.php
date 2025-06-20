<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceBranch extends Model
{
    use HasFactory;

    protected $table = 'price_branches';
    protected $primaryKey = "id";
    protected $fillable = [
        'branch_id',
        'strip',
        'price',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}

