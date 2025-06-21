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
        Schema::create('documentation_tickets', function (Blueprint $table) {
            $table->id();
            // Good practice
            // $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
            $table->string('ticket_id');
            $table->string('file_path');
            // Good practice 
            //$table->foreignId('uploaded_by')->constrained('users');
            $table->string('uploaded_by');
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
        Schema::dropIfExists('documentation_tickets');
    }
};
