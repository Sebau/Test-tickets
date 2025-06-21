<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // 1,2 or 3
            $table->string('mode_of_transport'); // Air, Land or Sea 
            $table->string('product');
            $table->string('product_condition'); // Import or Export
            $table->string('country_origin');
            $table->string('country_destination');
            $table->string('status')->default('new');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
