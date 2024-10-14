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
        Schema::create('main_cates', function (Blueprint $table) {
            $table->id();
            $table->string('MainCate_Name')->nullable()->comment('類別名稱');
            $table->string('Module_Name')->nullable()->comment('模組名稱');
            $table->string('MainCate_Color')->nullable()->comment('類別顏色');
            $table->string('MainCate_FontColor')->nullable()->comment('類別字體顏色');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_cates');
    }
};
