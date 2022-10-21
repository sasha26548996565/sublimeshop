<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('promo_code_options', function (Blueprint $table) {
            $table->id();

            $table->unsignedTinyInteger('discount');
            $table->foreignId('promo_code_id')->constrained();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('promo_code_options');
    }
};
