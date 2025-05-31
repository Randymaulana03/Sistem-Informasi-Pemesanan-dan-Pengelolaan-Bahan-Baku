<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    protected $fillable = ['name', 'description', 'total_price', 'stock']; // sesuaikan atribut

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_laptop')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
    public function components()
{
    return $this->belongsToMany(Component::class)
                ->withPivot('quantity')
                ->withTimestamps();
}


}
