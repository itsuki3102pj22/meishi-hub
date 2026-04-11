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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete(); // 会社ID
            $table->foreignId('card_id')->nullable()->constrained()->nullOnDelete(); //　名刺ID
            $table->string('name'); //　商談メイ
            $table->enum('status', ['lead', 'proposal', 'negotiation', 'won', 'lost'])->default('lead'); //　ステータス
            $table->bigInteger('amount')->nullable(); //　金額
            $table->integer('progress')->default(0); //　進捗率
            $table->date('close_date')->nullable(); //　クローズ予定日
            $table->text('memo')->nullable(); //　メモ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
