<?php

namespace LeadStore\Framework\Product\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use LeadStore\Framework\Models\Database\Property;
use LeadStore\Framework\Product\DataGrid\PropertyDataGrid;
use LeadStore\Framework\Product\Requests\PropertyRequest;
use LeadStore\Framework\System\Controllers\Controller;
use LeadStore\Framework\Models\Contracts\PropertyInterface;

class PropertyController extends Controller
{
    /**
     *
     * @var \LeadStore\Framework\Models\Repository\PropertyRepository
     */
    protected $repository;

    public function __construct(PropertyInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the Property.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertyGrid = new PropertyDataGrid($this->repository->query()->orderBy('id', 'desc'));

        return view('avored-framework::product.property.index')
                    ->with('dataGrid', $propertyGrid->dataGrid);
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-framework::product.property.create');
    }

    /**
     * Store a newly created property in database.
     *
     * @param \LeadStore\Framework\Product\Requests\PropertyRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        $property = $this->repository->create($request->all());

        $this->_saveDropdownOptions($property, $request);

        return redirect()->route('admin.property.index');
    }

    /**
     * Show the form for editing the specified property.
     *
     * @param \LeadStore\Framework\Models\Database\Property $property
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        return view('avored-framework::product.property.edit')->with('model', $property);
    }

    /**
     * Update the specified property in database.
     *
     * @param \LeadStore\Framework\Product\Requests\PropertyRequest $request
     * @param \LeadStore\Framework\Models\Database\Property $property
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $property->update($request->all());

        $this->_saveDropdownOptions($property, $request);

        return redirect()->route('admin.property.index');
    }

    /**
     * Remove the specified property from storage.
     *
     * @param \LeadStore\Framework\Models\Database\Property $property
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('admin.property.index');
    }

    /**
     * Get the Element Html in Json Response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getElementHtml(Request $request)
    {
        $properties = $this->repository->findMany($request->get('property_id'));

        $tmpString = str_random();
        $view = view('avored-framework::product.property.get-element')
                        ->with('properties', $properties)
                        ->with('tmpString', $tmpString);


        $json = new JsonResponse(['success' => true, 'content' => $view->render()]);

        return $json;
    }

    /**
     * Save Property Dropdown Field options
     *
     * @param \LeadStore\Framework\Models\Database\Property $proerty
     * @param \LeadStore\Framework\Product\Request\PropertyRequest $request
     *
     * @return void
     */
    private function _saveDropdownOptions($property, $request)
    {
        if (null !== $request->get('dropdown-options')) {
            $existingIds = $property->propertyDropdownOptions->keyBy('id');
            foreach ($request->get('dropdown-options') as $key => $val) {
                if ($key == '__RANDOM_STRING__') {
                    continue;
                }

                if ($existingIds->has($key)) {
                    $existingIds->pull($key);
                }

                if (is_int($key)) {
                    $property->propertyDropdownOptions()->find($key)->update($val);
                } else {
                    $property->propertyDropdownOptions()->create($val);
                }
            }
            if ($existingIds->count() > 0) {
                foreach ($existingIds as $option) {
                    $option->delete();
                }
            }
        }
    }

    /**
     * Find a Record and Returns a Html Resrouce for that Record
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return view('avored-framework::product.property.show')->with('property', $property);
    }
}
