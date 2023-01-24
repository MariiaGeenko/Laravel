<?php

declare(strict_types=1);

namespace App\Http\Controllers;
use Illuminate\Cache\RetrievesMultipleKeys;
use PhpParser\Node\Stmt\Return_;

trait CategoryNewsTrait
{
    public function getCategoryNews(int $id = null): array
    {
        $category = [];
        $quantityNews = 10;

        if ($id === null) {
            for($i=1; $i < $quantityNews; $i++) {
                $category[$i] = [
                    'id' => $i,
                    'title' => \fake()->jobTitle(),
                    'category_id' => \fake()->unique()->randomDigit(),
                    'description' => \fake()->text(100),
                    'author' => \fake()->userName(),
                    'created_at' => \now()->format('d-m-y h:i'),
                ];
            }

            return $category;
        }

        return [
            'id' => $id,
            'title' => \fake()->jobTitle(),
            'description' => \fake()->text(100),
            'author' => \fake()->userName(),
            'created_at' => \now()->format('d-m-y h:i'),
        ];
    }
}