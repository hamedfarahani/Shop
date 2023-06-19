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
        Schema::create('attribute_product_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_product_id');
            $table->string('label');
            $table->string('value');
            $table->decimal('price', 8, 2);
            $table->integer('sell_count')->default(0);
            $table->timestamps();

            $table->foreign('attribute_product_id')->references('id')->on('attribute_product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_product_values');
    }
};
