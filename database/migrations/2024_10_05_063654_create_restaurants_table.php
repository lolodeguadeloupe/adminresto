<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->foreignId('restaurant_type_id')->constrained()->onDelete('restrict');
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('restaurant_type_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('address');
            $table->string('phone');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
