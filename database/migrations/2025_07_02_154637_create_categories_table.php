<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // ✅ Create categories table if it doesn't exist
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->timestamps();
            });
        }

        // ✅ Add category_id column and foreign key to menu_items table
        if (Schema::hasTable('menu_items') && !Schema::hasColumn('menu_items', 'category_id')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->unsignedBigInteger('category_id')->after('id'); // Adjust position if needed
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        // ✅ Drop foreign key and category_id column from menu_items table
        if (Schema::hasTable('menu_items') && Schema::hasColumn('menu_items', 'category_id')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            });
        }

        // ✅ Drop categories table
        Schema::dropIfExists('categories');
    }
};
