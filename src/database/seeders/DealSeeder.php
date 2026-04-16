<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Deal;
use App\Models\User;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        
        $deals = [
            ['company_id' => 1, 'card_id' => 1, 'name' => 'ERPシステム導入', 'status' => 'negotiation', 'amount' => 3200000, 'progress' => 70, 'close_date' => '2026-05-15', 'memo' => '基幹業務システムのERP化について検討中。競合2社と比較検討中。'],
            ['company_id' => 2, 'card_id' => 3, 'name' => 'Webサイトリニューアル', 'status' => 'won', 'amount' => 1800000, 'progress' => 100, 'close_date' => '2026-04-01', 'memo' => '受注済み。制作開始。'],
            ['company_id' => 3, 'card_id' => 4, 'name' => 'クラウド移行支援', 'status' => 'proposal', 'amount' => 2500000, 'progress' => 40, 'close_date' => '2026-04-30', 'memo' => 'AWSへの移行を提案中。'],
            ['company_id' => 4, 'card_id' => 5, 'name' => 'セキュリティ監査', 'status' => 'negotiation', 'amount' => 890000, 'progress' => 60, 'close_date' => '2026-05-30', 'memo' => 'セキュリティ診断から始める予定。'],
            ['company_id' => 5, 'card_id' => null, 'name' => 'CRM導入検討', 'status' => 'lead', 'amount' => 1200000, 'progress' => 15, 'close_date' => '2026-06-30', 'memo' => '初回ヒアリング済み。'],
        ];
        
        foreach ($deals as $deal) {
            $deal['user_id'] = $user->id;
            Deal::create($deal);
        }
    }
}
