<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['customer_name', 'customer_phone', 'customer_address', 'total_price', 'user_id', 'payment_method'];


    public function laptops()
    {
        // many-to-many dengan pivot quantity dan price
        return $this->belongsToMany(Laptop::class, 'order_laptop')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();

    }
    
    public function user()
    {
    return $this->belongsTo(User::class);
    }
    // app/Models/Order.php
public function laptop()
{
    return $this->belongsTo(Laptop::class);
}


    

// ...




}
