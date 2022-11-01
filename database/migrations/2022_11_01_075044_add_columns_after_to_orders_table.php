<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address_2')->nullable();
            $table->string('company')->nullable();
            $table->foreignId('country_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('province_id')->nullable()->constrained()->onDelete('SET NULL');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'address_2', 'company', 'country_id', 'province_id']);
        });
    }
};
