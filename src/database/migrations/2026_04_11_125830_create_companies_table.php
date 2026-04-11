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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 会社名
            $table->string('name_kana')->nullable(); // 会社名カナ
            $table->string('industry')->nullable(); //　業種
            $table->string('phone')->nullable(); //　電話番号
            $table->string('website')->nullable(); //WebサイトURL
            $table->text('address')->nullable(); //　住所
            $table->text('memo')->nullable(); // メモ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
