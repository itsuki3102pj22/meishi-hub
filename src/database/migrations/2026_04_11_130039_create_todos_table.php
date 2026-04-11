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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deal_id')->nullable()->constrained()->nullOnDelete(); // 商談ID
            $table->foreignId('card_id')->nullable()->constrained()->nullOnDelete(); //　名刺ID
            $table->string('title'); //　タイトル
            $table->date('due_date')->nullable(); //　期限
            $table->boolean('is_done')->default(false); //　完了フラグ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
