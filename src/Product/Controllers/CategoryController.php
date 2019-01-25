<?php

namespace LeadStore\Framework\Product\Controllers;

use LeadStore\Framework\Models\Database\Category;
use LeadStore\Framework\Product\Requests\CategoryRequest;
use LeadStore\Framework\Models\Contracts\CategoryInterface;
use LeadStore\Framework\Product\DataGrid\CategoryDataGrid;
use LeadStore\Framework\System\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     *
     * @var \LeadStore\Framework\Models\Repository\CategoryRepository
     */
    protected $repository;

    public function __construct(CategoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryGrid = new CategoryDataGrid($this->repository->query());
        $parentCategories = $this->repository->query()
            ->with(['children'])
            ->orderBy('name', 'ASC')
            ->whereNull('parent_id')->get();

        return view('avored-framework::product.category.index', [
            'dataGrid' => $categoryGrid->dataGrid,
            'parentCategories' => $parentCategories
        ]);
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-framework::product.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \LeadStore\Framework\Product\Requests\CategoryRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \LeadStore\Framework\Models\Database\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('avored-framework::product.category.edit')->with('model', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \LeadStore\Framework\Product\Requests\CategoryRequest $request
     * @param \LeadStore\Framework\Models\Database\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \LeadStore\Framework\Models\Database\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        foreach ($category->children as $child) {
            $child->parent_id = 0;
            $child->update();
        }

        $category->delete();

        return redirect()->route('admin.category.index');
    }

    /**
     * Find a Record and Returns a Html Resrouce for that Record
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('avored-framework::product.category.show')->with('category', $category);
    }
}
