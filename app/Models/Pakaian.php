<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pakaian extends Model
{
    
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'product_id');
    }

}
