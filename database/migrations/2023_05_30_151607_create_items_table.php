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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('category_id');
            $table->string('price');
            $table->longText('description');
            $table->string('condition')->default('New');
            $table->string('type',15)->default('Sell');
            $table->tinyInteger('status')->default('0')->comment('0=unavailable,1=available');
            $table->string('owner_name');
            $table->string('phone',15)->nullable();
            $table->string('address')->nullable();
            $table->string('lat_long');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
