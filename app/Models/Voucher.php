<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_name',
        'voucher_enabled',
        'voucher_quantity',
    ];

    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
