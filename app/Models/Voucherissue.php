<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucherissue extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_code',
        'post_id',
        'user_id',
    ];
}
