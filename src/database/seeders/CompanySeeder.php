<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['name' => '株式会社テクノ', 'name_kana' => 'カブシキガイシャテクノ', 'industry' => 'IT・ソフトウェア', 'phone' => '03-1234-5678', 'address' => '東京都港区赤坂1-1-1'],
            ['name' => 'ABCコーポレーション', 'name_kana' => 'エービーシーコーポレーション', 'industry' => '製造・商社', 'phone' => '03-2345-6789', 'address' => '東京都渋谷区渋谷2-2-2'],
            ['name' => 'DEFソリューション', 'name_kana' => 'ディーイーエフソリューション', 'industry' => 'コンサルティング', 'phone' => '03-3456-7890', 'address' => '大阪府大阪市北区3-3-3'],
            ['name' => 'GHIインダストリー', 'name_kana' => 'ジーエイチアイインダストリー', 'industry' => '重工業・製造', 'phone' => '03-4567-8901', 'address' => '愛知県名古屋市中区4-4-4'],
            ['name' => 'JKLエンタープライズ', 'name_kana' => 'ジェイケイエルエンタープライズ', 'industry' => '流通・物流', 'phone' => '03-5678-9012', 'address' => '福岡県福岡市博多区5-5-5'],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
