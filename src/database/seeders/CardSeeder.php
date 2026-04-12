<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Card;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $cards = [
            ['company_id' => 1, 'last_name' => '山田', 'first_name' => '太郎', 'last_name_kana' => 'ヤマダ', 'first_name_kana' => 'タロウ', 'department' => '営業部', 'position' => '部長', 'email' => 'yamada@techno.co.jp', 'phone' => '03-1234-5678', 'mobile' => '090-1234-5678', 'memo' => 'IT展示会で名刺交換。ERPシステムの導入に強い関心あり。'],
            ['company_id' => 1, 'last_name' => '伊藤', 'first_name' => '健一', 'last_name_kana' => 'イトウ', 'first_name_kana' => 'ケンイチ', 'department' => '技術部', 'position' => '取締役CTO', 'email' => 'ito@techno.co.jp', 'phone' => '03-1234-0001', 'memo' => '技術的な決裁権限あり。'],
            ['company_id' => 2, 'last_name' => '鈴木', 'first_name' => '花子', 'last_name_kana' => 'スズキ', 'first_name_kana' => 'ハナコ', 'department' => '経営企画', 'position' => '取締役', 'email' => 'suzuki@abc.co.jp', 'phone' => '03-2345-6789', 'mobile' => '090-2345-6789', 'memo' => 'Webリニューアルに積極的。'],
            ['company_id' => 3, 'last_name' => '田中', 'first_name' => '次郎', 'last_name_kana' => 'タナカ', 'first_name_kana' => 'ジロウ', 'department' => 'IT推進部', 'position' => 'マネージャー', 'email' => 'tanaka@def.co.jp', 'phone' => '03-3456-7890', 'memo' => 'クラウド移行を検討中。'],
            ['company_id' => 4, 'last_name' => '佐藤', 'first_name' => '美咲', 'last_name_kana' => 'サトウ', 'first_name_kana' => 'ミサキ', 'department' => '総務部', 'position' => '代表取締役', 'email' => 'sato@ghi.co.jp', 'phone' => '03-4567-8901', 'mobile' => '090-4567-8901', 'memo' => 'セキュリティ強化に関心あり。'],
         ];
         
         foreach ($cards as $card) {
            Card::create($card);
         }
    }
}
