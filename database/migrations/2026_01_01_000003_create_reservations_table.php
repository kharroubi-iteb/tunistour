<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('place_name');
            $table->string('place_type');
            $table->date('date'); // date of departure / booking
            $table->string('status')->default('confirmed');
            $table->string('price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
