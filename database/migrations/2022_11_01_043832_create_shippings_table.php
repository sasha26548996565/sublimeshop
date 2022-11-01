<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->unsignedDouble('price');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shippings');
    }
};
