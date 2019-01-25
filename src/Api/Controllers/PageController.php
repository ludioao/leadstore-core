<?php

namespace LeadStore\Framework\Api\Controllers;

use Illuminate\Http\JsonResponse;
use LeadStore\Framework\Models\Database\Page;
use LeadStore\Framework\Api\Resources\Page\PageResource;
use LeadStore\Framework\Api\Resources\Page\PageCollectionResource;
use LeadStore\Framework\Cms\Requests\PageRequest;

class PageController extends Controller
{
    /**
     * Return upto 10 Record for an Resource in Json Formate
     *
     * @return \Illuminate\Http\Resources\CollectsResources
     */
    public function index()
    {
        $pages = Page::paginate(10);

        return new PageCollectionResource($pages);
    }

    /**
     * Create an Resource and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(PageRequest $request)
    {
        $page = Page::create($request->all());

        return (new PageResource($page));
    }

    /**
     * Find a Record and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Page $page)
    {
        return new PageResource($page);
    }

    /**
     * Update and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->all());
        return new PageResource($page);
    }

    /**
     * Destroy an Record and Return Null Json Response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return JsonResponse::create(null, 204);
    }
}
