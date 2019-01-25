<?php

namespace LeadStore\Framework\Cms\Controllers;

use LeadStore\Framework\Models\Database\Page;
use LeadStore\Framework\Cms\DataGrid\PageDataGrid;
use LeadStore\Framework\Cms\Requests\PageRequest;
use LeadStore\Framework\Models\Contracts\PageInterface;
use LeadStore\Framework\System\Controllers\Controller;

class PageController extends Controller
{
    /**
     *
     * @var \LeadStore\Framework\Models\Repository\PageRepository
     */
    protected $repository;

    public function __construct(PageInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the Page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pageGrid = new PageDataGrid($this->repository->query());

        return view('avored-framework::cms.page.index')->with('dataGrid', $pageGrid->dataGrid);
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('avored-framework::cms.page.create');
    }

    /**
     * Store a newly created page in database.
     *
     * @param \AvoRed\Frameowork\Cms\Requests\PageRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PageRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.page.index');
    }

    /**
     * Show the form for editing the specified page.
     *
     * @param \LeadStore\Framework\Models\Database\Page $page
     *
     * @return \Illuminate\View\View
     */
    public function edit(Page $page)
    {
        return view('avored-framework::cms.page.edit')
            ->with('model', $page);
    }

    /**
     * Update the specified page in database.
     *
     * @param \LeadStore\Framework\Cms\Requests\PageRequest $request
     * @param \LeadStore\Framework\Models\Database\Page $page
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->all());
        return redirect()->route('admin.page.index');
    }

    /**
     * Remove the specified page from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.page.index');
    }

    /**
     * Find a Record and Returns a Json Resrouce for that Record
     *
     * @param \LeadStore\Framework\Models\Database\Page $page
     * @return \Illuminate\View\View
     */
    public function show(Page $page)
    {
        return view('avored-framework::cms.page.show')
                    ->with('page', $page);
    }
}
