<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commercial_places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('lieus')->onDelete('cascade');
            $table->string('name');
            $table->string('type'); // 'hotel', 'restaurant', etc.
            $table->string('price');
            $table->float('rating')->default(5.0);
            $table->text('description')->nullable();
            $table->text('image_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commercial_places');
    }
};
