<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lieus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('region');
            $table->text('description');
            $table->text('image_url')->nullable();
            $table->string('category'); // e.g. 'monument', 'exploration'
            $table->float('rating')->default(5.0);
            $table->json('tags')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lieus');
    }
};
