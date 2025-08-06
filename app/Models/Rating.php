<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pakaian()
    {
        return $this->belongsTo(Pakaian::class, 'product_id');
    }
}
