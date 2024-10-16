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
        Schema::create('data_files', function (Blueprint $table) {
            $table->id();
            $table->string('File_Name');      // 原始檔案名稱
            $table->string('File_FakeName');  // 存放時的檔案名稱
            $table->string('File_Ext');       // 檔案副檔名
            $table->string('Module');         // 模組名稱（例如 Bulletin）
            $table->unsignedBigInteger('AutoID'); // 對應 Bulletin 或其他模組 ID
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_files');
    }
};
