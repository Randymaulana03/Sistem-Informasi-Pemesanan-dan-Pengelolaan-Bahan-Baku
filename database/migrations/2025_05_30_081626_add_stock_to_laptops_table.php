<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('laptops', function (Blueprint $table) {
        $table->integer('stock')->default(0)->after('name');
    });
}

public function down()
{
    Schema::table('laptops', function (Blueprint $table) {
        $table->dropColumn('stock');
    });
}


};
