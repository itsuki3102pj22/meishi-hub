<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Todo;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $todos = [
            ['deal_id' => 1, 'card_id' => 1, 'title' => '提案書の送付', 'due_date' => '2026-04-10', 'is_done' => true],
            ['deal_id' => 1, 'card_id' => 1, 'title' => '見積書作成・送付', 'due_date' => '2026-04-15', 'is_done' => false],
            ['deal_id' => 1, 'card_id' => 1, 'title' => '技術デモの実施', 'due_date' => '2026-04-22', 'is_done' => false],
            ['deal_id' => 2, 'card_id' => 3, 'title' => 'キックオフMTG', 'due_date' => '2026-04-05', 'is_done' => true],
            ['deal_id' => 3, 'card_id' => 4, 'title' => 'クラウド移行資料収集', 'due_date' => '2026-04-14', 'is_done' => false],
            ['deal_id' => 4, 'card_id' => 5, 'title' => 'セキュリティ診断の日程調整', 'due_date' => '2026-04-20', 'is_done' => false],
        ];

        foreach ($todos as $todo) {
            Todo::create($todo);
        }
    }
}
