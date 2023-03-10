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
        Schema::create('item_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->integer('addedCount');
            $table->integer('removedCount');
            $table->integer('purchasedCount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('removed_items');
    }
};
