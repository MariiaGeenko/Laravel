<?php

declare(strict_types=1);

namespace App\Http\Controllers;
use Illuminate\Cache\RetrievesMultipleKeys;
use PhpParser\Node\Stmt\Return_;

trait CatigoryNewsTrait
{
    public function getCatigoryNews(int $id = null): array
    {
        $catigory = [];
        $quantityNews = 10;

        if ($id === null) {
            for($i=1; $i < $quantityNews; $i++) {
                $catigory[$i] = [
                    'id' => $i,
                    'title' => \fake()->jobTitle(),
                    'catigory_id' => \fake()->text(100),
                    'description' => \fake()->text(100),
                    'author' => \fake()->userName(),
                    'created_at' => \now()->format('d-m-y h:i'),
                ];
            }

            return $catigory;
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