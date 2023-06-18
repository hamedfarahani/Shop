<?php

namespace Database\Seeders;

use App\Enum\AttributeEnum;
use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platforms = [
            [
                "title" => AttributeEnum::COLOR,
            ],
            [
                "title" => AttributeEnum::SIZE,
            ],
        ];

        foreach ($platforms as $platform) {
            Attribute::updateOrCreate(['title' => $platform['title']], $platform);
        }
    }
}
