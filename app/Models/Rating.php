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

    public function replies()
    {
        return $this->hasMany(Rating::class, 'parent_id');    
    }

    public function parent()
    {
        return $this->belongsTo(Rating::class, 'parent_id');
    }
}
