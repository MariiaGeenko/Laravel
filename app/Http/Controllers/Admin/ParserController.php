<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Parser;
use Illuminate\Http\Request;
use App\Jobs\JobNewsParser;
use App\Models\News;
use App\Models\Source;
use App\QueryBuilders\SourceQueryBuilder;
use App\Services\ParserServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param SourceQueryBuilder $sourceQueryBuilder
     * @param Request $request
     * @return View|Factory|Application
     */
    public function __invoke(SourceQueryBuilder $sourceQueryBuilder, Request $request): View|Factory|Application
    {

        $urls = $sourceQueryBuilder->getAll()->pluck('link');
        //        dd($urls);
        foreach ($urls as $url){
            \dispatch(new JobNewsParser($url));

        }
        return \view('admin.parser.index');
    }
}
