<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'pakaian_id',
        'jumlah_order',
        'harga_peritem',
        'total_order',
        'alamat_id',
        'user_id',
        'status'
    ];

    protected $casts = [
        'pakaian_id' => 'array',
        'jumlah_order' => 'array',
        'harga_peritem' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if(empty($model->order_id)) {
                $model->order_id = (string) Str::uuid();
            }
        });
    }

    public function alamat() : BelongsTo
    {
        return $this->belongsTo(Alamat::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
