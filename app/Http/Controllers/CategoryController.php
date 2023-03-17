<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::with('products')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        $products = [];
        if (isset($validated['products'])) {
            $products = $validated['products'];
            unset($validated['products']);
        }

        $category = Category::create($validated);
        $category->products()->sync($products);
        $category->load('products');

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load('products');

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $category->name = $validated['name'];
        $category->enable = $validated['enable'];
        $category->save();
        if (isset($validated['products'])) {
            $products = $validated['products'];
            unset($validated['products']);
            $category->products()->sync($products);
        }

        $category->load('products');

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->products()->detach();
        $category->delete();

        return ['message' => 'resource deleted'];
    }
}
