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
        // companiesテーブルにuser_idを追加
        Schema::table('companies', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
        });

        // cardsテーブルにuser_idを追加
        Schema::table('cards', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
        });

        // dealsテーブルにuser_idを追加
        Schema::table('deals', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
        });

        // todosテーブルにuser_idを追加
        Schema::table('todos', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('deals', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
