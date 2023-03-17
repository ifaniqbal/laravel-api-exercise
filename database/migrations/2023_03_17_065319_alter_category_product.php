<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('category_product', function (Blueprint $table) {
            $table->unique(['category_id', 'product_id']);
        });
        Schema::table('image_product', function (Blueprint $table) {
            $table->unique(['image_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_product', function (Blueprint $table) {
            $table->dropUnique(['category_id', 'product_id']);
        });
        Schema::table('image_product', function (Blueprint $table) {
            $table->dropUnique(['image_id', 'product_id']);
        });
    }
};
