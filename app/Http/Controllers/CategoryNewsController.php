<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryNewsController extends Controller
{
    use CategoryNewsTrait;
    public function index()
    {
        return \view('category.index', [
            'category' => $this->getCategoryNews(),
        ]);
    }

    public function show(int $id)
    {
        return $this->getCategoryNews($id);
    }
}
