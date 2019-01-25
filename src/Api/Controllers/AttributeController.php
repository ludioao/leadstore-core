<?php

namespace LeadStore\Framework\Api\Controllers;

use Illuminate\Http\JsonResponse;
use LeadStore\Framework\Models\Database\Attribute;
use LeadStore\Framework\Api\Resources\Attribute\AttributeResource;
use LeadStore\Framework\Api\Resources\Attribute\AttributeCollectionResource;
use LeadStore\Framework\Product\Requests\AttributeRequest;

class AttributeController extends Controller
{
    /**
     * Return upto 10 Record for an Resource in Json Formate
     *
     * @return \Illuminate\Http\Resources\CollectsResources
     */
    public function index()
    {
        $attributes = Attribute::paginate(10);

        return new AttributeCollectionResource($attributes);
    }

    /**
     * Create an Resource and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(AttributeRequest $request)
    {
        $attribute = Attribute::create($request->all());

        return (new AttributeResource($attribute));
    }

    /**
     * Find a Record and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Attribute $attribute)
    {
        return new AttributeResource($attribute);
    }

    /**
     * Update and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(AttributeRequest $request, Attribute $attribute)
    {
        $attribute->update($request->all());
        return new AttributeResource($attribute);
    }

    /**
     * Destroy an Record and Return Null Json Response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return JsonResponse::create(null, 204);
    }
}
