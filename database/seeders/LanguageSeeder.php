<?php

namespace Database\Seeders;


use App\Models\Global\Language;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'Indonesia',
                'code' => 'id',
                'is_active' => true,
            ],
            [
                'name' => 'English',
                'code' => 'en',
                'is_active' => false,
            ],
            [
                'name' => 'Chinese',
                'code' => 'zh',
                'is_active' => false,
            ],
        ];
        foreach ($datas as $data) {
            Language::create($data);
        }
    }
}
