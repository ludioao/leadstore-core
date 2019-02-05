<?php

namespace LeadStore\Framework\Product\ViewComposers;

use LeadStore\Framework\Models\Database\Category;
use Illuminate\View\View;

class ProductFieldsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $categoryOptions = Category::with('children')->whereNull('parent_id')->get();
        $storageOptions = []; //Storage::pluck('name', 'id');
        $view->with('categoryOptions', $categoryOptions)
            ->with('storageOptions', $storageOptions);
    }
}
