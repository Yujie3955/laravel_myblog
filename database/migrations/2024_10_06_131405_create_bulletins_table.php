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
        Schema::create('bulletins', function (Blueprint $table) {
            $table->id();
            $table->string('Bulletin_Title')->nullable()->comment('公告標題');
            $table->date('Bulletin_StartDate')->nullable()->comment('公告上架時間');
            $table->date('Bulletin_EndDate')->nullable()->comment('公告下架時間');
            $table->longText('Bulletin_Content')->nullable()->comment('公告內容(編輯器內容)');
            $table->enum('Bulletin_Forever',['0','1'])->default('0')->comment('公告是否永遠公告(0=不會永遠公告、1=永遠公告，不看上下架時間)');
            $table->enum('Bulletin_Enable',['0','1'])->default('0')->comment('公告是否顯示(0=不顯示、1=顯示，但是需要依照上下架時間)');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulletins');
    }
};
