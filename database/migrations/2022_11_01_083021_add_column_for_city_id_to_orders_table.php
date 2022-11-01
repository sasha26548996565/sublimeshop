<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('SET NULL');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('city_id');
        });
    }
};
