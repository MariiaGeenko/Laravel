<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\NewsStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\EditRequest;
use App\Models\News;
use App\QueryBuilders\CategoriesQueryBuilder;
use App\QueryBuilders\NewsQueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use App\Services\UploadService;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param NewsQueryBuilder $newsQueryBuilder
     * @return View
     */
    public function index(NewsQueryBuilder $newsQueryBuilder): View
    {
        return \view('admin.news.index', [
            'newsList' => $newsQueryBuilder->getNewsWithPagination(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CategoriesQueryBuilder $categoriesQueryBuilder
     * @return View
     */
    public function create(CategoriesQueryBuilder $categoriesQueryBuilder,): View
    {
        return \view('admin.news.create', [
            'categories' => $categoriesQueryBuilder->getAll(),
            'statuses' => NewsStatus::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $news = News::create($request->validated());

        if ($news) {
            $news->categories()->attach($request->getCategoryIds());
            return \redirect()->route('admin.news.index')->with('success', __('messages.admin.news.success'));
        }

        return \back()->with('error', __('messages.admin.news.fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @param CategoriesQueryBuilder $categoriesQueryBuilder
     * @return View
     */
    public function edit(News $news, CategoriesQueryBuilder $categoriesQueryBuilder): View
    {
        return \view('admin.news.edit', [
            'news' => $news,
            'categories' => $categoriesQueryBuilder->getAll(),
            'statuses' => NewsStatus::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditRequest $request
     * @param News $news
     * @param UploadService $uploadService
     * @return RedirectResponse
     */

    public function update(EditRequest $request, News $news, UploadService $uploadService): RedirectResponse
    {
        $validates = $request->validated();
        $news = $news->fill($validates);

        if ($request->hasFile('image')) {
            $validates['image'] = $uploadService->uploadImage($request->file('image'));
        }

        if ($news->update($validates)) {
            $news->categories()->sync($request->getCategoryIds());
            return \redirect()->route('admin.news.index')->with('success', __('messages.admin.news.success'));
        }
        return \back()->with('error', __('messages.admin.news.fail'));
    }

        /**
         * Remove the specified resource from storage.
         *
         * @param News $news
         * @return \Illuminate\Http\JsonResponse
         */
        public
        function destroy(News $news): \Illuminate\Http\JsonResponse
        {
            try {
                $news->delete();

                return \response()->json('ok');
            } catch (\Exception $exception) {
                \Log::error($exception->getMessage(), [$exception]);

                return response()->json('error', 400);
            }
        }
    }
