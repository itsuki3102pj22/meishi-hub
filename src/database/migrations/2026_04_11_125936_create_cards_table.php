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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete(); // 会社ID
            $table->string('last_name'); //　姓
            $table->string('first_name'); // 名
            $table->string('last_name_kana')->nullable(); //　セイ
            $table->string('first_name_kana')->nullable(); //　メイ
            $table->string('department')->nullable(); //　部署
            $table->string('position')->nullable(); //　役職
            $table->string('email')->nullable(); //　メールアドレス
            $table->string('phone')->nullable(); //　電話番号
            $table->string('mobile')->nullable(); //　携帯電話番号
            $table->string('fax')->nullable(); //　Fax番号
            $table->text('memo')->nullable(); //　メモ
            $table->string('image_path')->nullable(); //　画像
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
