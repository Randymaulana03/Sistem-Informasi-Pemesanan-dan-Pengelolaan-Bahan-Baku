<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $fillable = ['name', 'type', 'stock', 'unit_price'];

    public function laptops()
    {
        return $this->belongsToMany(Laptop::class)
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

}


