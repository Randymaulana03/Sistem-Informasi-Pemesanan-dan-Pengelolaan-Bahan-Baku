<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('component_laptop', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laptop_id')->constrained()->onDelete('cascade');
            $table->foreignId('component_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1); // Jumlah komponen yang dipakai
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('component_laptop');
    }
};
