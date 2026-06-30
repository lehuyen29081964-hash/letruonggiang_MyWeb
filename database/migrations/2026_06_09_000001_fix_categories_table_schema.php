<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('categories')) {
            return;
        }

        // Nếu bảng đang có cột id mặc định, đổi sang cateid theo mẫu của cô.
        if (Schema::hasColumn('categories', 'id') && ! Schema::hasColumn('categories', 'cateid')) {
            DB::statement('ALTER TABLE categories DROP PRIMARY KEY, DROP COLUMN id, ADD cateid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');
        }

        Schema::table('categories', function (Blueprint $table) {
            if (! Schema::hasColumn('categories', 'catename')) {
                $table->string('catename', 100)->unique()->after('cateid');
            }
            if (! Schema::hasColumn('categories', 'slug')) {
                $table->string('slug', 150)->unique()->after('catename');
            }
            if (! Schema::hasColumn('categories', 'image')) {
                $table->string('image')->nullable()->after('slug');
            }
            if (! Schema::hasColumn('categories', 'status')) {
                $table->tinyInteger('status')->default(1)->after('image');
            }
            if (! Schema::hasColumn('categories', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('status');
            }
            if (! Schema::hasColumn('categories', 'description')) {
                $table->text('description')->nullable()->after('sort_order');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('categories')) {
            return;
        }

        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('categories', 'sort_order')) {
                $table->dropColumn('sort_order');
            }
            if (Schema::hasColumn('categories', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('categories', 'image')) {
                $table->dropColumn('image');
            }
            if (Schema::hasColumn('categories', 'slug')) {
                $table->dropColumn('slug');
            }
            if (Schema::hasColumn('categories', 'catename')) {
                $table->dropColumn('catename');
            }
        });

        if (Schema::hasColumn('categories', 'cateid') && ! Schema::hasColumn('categories', 'id')) {
            DB::statement('ALTER TABLE categories DROP PRIMARY KEY, DROP COLUMN cateid, ADD id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');
        }
    }
};