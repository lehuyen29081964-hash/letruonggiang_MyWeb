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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('cateid'); // Khóa chính tự tăng
            $table->string('catename', 100)->unique(); // Tên danh mục
            $table->string('slug', 150)->unique(); // Slug
            $table->string('image')->nullable(); // Hình ảnh
            $table->tinyInteger('status')->default(1); // Trạng thái
            $table->integer('sort_order')->default(0); // Thứ tự sắp xếp
            $table->text('description')->nullable(); // Mô tả
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
