<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\NewsStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        \DB::table('resources')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [];
        for ($i = 0; $i<10; $i++)
        {
            $data[] = [
                'title' => \fake()->jobTitle(),
                'description' => \fake()->text(100),
            ];
        }
        return $data;
    }
}
