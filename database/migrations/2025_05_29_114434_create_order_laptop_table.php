<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderLaptopTable extends Migration
{
    public function up()
    {
        Schema::create('order_laptop', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('laptop_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('price'); // harga per unit saat order
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_laptop');
    }
}
