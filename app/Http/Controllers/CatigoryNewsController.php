<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatigoryNewsController extends Controller
{
    use CatigoryNewsTrait;
    public function index()
    {
        return \view('catigory.index', [
            'catigory' => $this->getCatigoryNews(),
        ]);
    }

    public function show(int $id)
    {
        return $this->getCatigoryNews($id);
    }
}
