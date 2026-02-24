<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->after('slug');
            $table->integer('price')->default(0);
            $table->integer('stock')->default(0);
            $table->string('size')->nullable();
            $table->string('material')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_featured')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'price',
                'stock',
                'size',
                'material',
                'description',
                'image',
                'is_featured',
            ]);
        });
    }
};