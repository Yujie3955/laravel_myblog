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
        Schema::table('bulletins', function (Blueprint $table) {
            // 新增 main_cate_id 外鍵
            $table->foreignId('main_cate_id')->constrained('main_cates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bulletins', function (Blueprint $table) {
            // 先移除外鍵，再刪除欄位
            $table->dropForeign(['main_cate_id']);
            $table->dropColumn('main_cate_id');
        });
    }
};
