<?php

namespace LeadStore\Framework\Models\Repository;

use LeadStore\Framework\Models\Contracts\CategoryInterface;
use LeadStore\Framework\Models\Database\Category;
use LeadStore\Framework\Models\Database\ProductPropertyIntegerValue;
use LeadStore\Framework\Models\Database\Property;
use LeadStore\Framework\Models\Database\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryInterface
{
    /**
     * Find an Category by given Id
     *
     * @param $id
     *
     * @return \LeadStore\Framework\Models\Database\Category
     */
    public function find($id)
    {
        return Category::find($id);
    }

    /**
     * Find an Category by given key which returns Category Model
     *
     * @param string $key
     *
     * @return \LeadStore\Framework\Models\Database\Category
     */
    public function findByKey($key)
    {
        return Category::whereSlug($key)->first();
    }

    /**
     * Find an Category by given Id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Category::all();
    }

    /**
     * Paginate Category
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return Category::paginate($noOfItem);
    }

    /**
     * Find an Category Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Category::query();
    }

    /**
     * Find an Category Query
     *
     * @return \LeadStore\Framework\Models\Database\Attribute
     */
    public function create($data)
    {
        return Category::create($data);
    }

    /*
    * Return Products of Category with Filters
    *
    *
    * @param integer $categoryId
    * @param array   $filters
    * @return \Illuminate\Support\Collection $collect
    */
    public function getCategoryProductWithFilter($categoryId, $filters = [])
    {
        //
        $category = $this->find($categoryId);
        $allCategories = collect($category->children);
        $allCategories->push($category);
        $categoriesIds = $allCategories->pluck('id')->toArray();

        $products = Product::where('status', true);
        if (!isset($filters['subCategory'])) {
            $callback = function ($q) use ($categoriesIds) {
                $q->whereIn('category_id', $categoriesIds);
            };
        } else {
            $subCategory = $filters['subCategory'];
            $callback = function($q) use ($subCategory) {
               $q->whereIn('category_id', [$subCategory]);
            };
        }

        $products = $products->whereHas('categories', $callback)
            ->with(['categories' => $callback]);

        $productIds = $products->pluck('id');

        // Filters
        $methodFilters = [];


        // Filters
        foreach ($filters as $type => $filterArray) {
            if ($type == 'property') {
                foreach ($filterArray as $identifier => $value) {
                    $property = Property::whereIdentifier($identifier)->first();
                    if ($property) {
                        $relationshipMethod = $property->getProductRelationship();
                        $methodFilters[$relationshipMethod][] = [$property->id => $value];
                    }
                }
            }
        }



        // Filters
        foreach ($methodFilters as $method => $values) {

            foreach($values as $value)
            {
                $propertyId = key($value);
                $value = $value[$propertyId];
                $callback = function($q) use ($propertyId, $value) {
                    $q->wherePropertyId($propertyId)
                        ->whereValue($value);
                };
                $productIdProperties = Product::whereHas($method, $callback)
                    ->with([$method => $callback])->pluck('id');

                // Overrite
                $productIds = $productIds->intersect($productIdProperties);
            }
        }


        if (isset($filters['orderby'])) {
            $order = $filters['orderby'];
            if (in_array($order, ['name', 'price', 'price-desc'])) {
                switch ($order) {
                    case 'name':
                        $products->orderBy('name', 'ASC');
                        break;
                    case 'price':
                        $products->orderBy('price', 'DESC');
                        break;
                    case 'price-desc':
                        $products->orderBy('price', 'ASC');
                        break;
                    default:
                        $products->latest();
                        break;
                }
            }
        }

        $products = $products->whereIn('id', $productIds);

        $categories = $category->children;

        return [$products->get(), $categories];
    }


    /**
     * @param $campaign
     *
     * @return array
     */
    public function getPropertyFilters($products)
    {
        $productIds = $products->where('status', true)->pluck('id');
        $propertiesIds = \DB::table('product_property')->whereIn('product_id', $productIds)->distinct('property_id')->pluck('property_id');
        $availableDropdownValues = ProductPropertyIntegerValue::whereIn('product_id', $productIds)->pluck('value');

        $availableDropdownValuesCallback = function($q) use ($availableDropdownValues) {
            $q->whereIn('id', $availableDropdownValues->unique()->toArray());
        };
        return Property::whereIn('id', $propertiesIds)
            ->with(['propertyDropdownOptions' => $availableDropdownValuesCallback])
            ->whereHas('propertyDropdownOptions', $availableDropdownValuesCallback)
            ->get();
    }


    /*
    * Paginate Category Page Product
    *
    *
    * @param \Illuminate\Support\Collection $products
    * @param integer $perPage
    * @return \Illuminate\Pagination\LengthAwarePaginator
    */

    public function paginateProducts($products, $perPage = 10)
    {
        $request = request();
        $page = request('page');
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            $products->slice($offset, $perPage), // Only grab the items we need
            $products->count(), // Total items
            $perPage, // Items per page
            $page, // Current page
            ['path' => $request->url(), 'query' => $request->query()] // We need this so we can keep all old query parameters from the url
        );
    }

    /**
     * Get an Category Options for Vue Components
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function options($empty = true)
    {
        if (true === $empty) {
            $empty = new Category();
            $empty->name = 'Selecione';
            return Category::whereNull('parent_id')->get()->prepend($empty);
        }
        return Category::all();
    }
}
