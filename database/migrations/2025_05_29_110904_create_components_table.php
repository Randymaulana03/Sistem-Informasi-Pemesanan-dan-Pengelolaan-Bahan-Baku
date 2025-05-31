<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama komponen (misal: RAM 8GB)
            $table->string('type'); // Jenis komponen (RAM, SSD, Prosesor)
            $table->integer('stock'); // Jumlah stok
            $table->integer('unit_price'); // Harga per unit
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
