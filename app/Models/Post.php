<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use KyslikColumnSortableSortable;

class Post extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'image',
        'user_id',
        'view',
        'voucher_id',
        'voucher_enabled',
        'voucher_quantity',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'id');
    }

    public function voucherissue()
    {
        return $this->hasMany(Voucherissue::class, 'post_id', 'id');
    }

}
