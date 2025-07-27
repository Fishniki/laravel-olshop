<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['pakaian_id', 'user_id'];

    public function pakaian() : BelongsTo
    {
        return $this->belongsTo(Pakaian::class);
    }
}
