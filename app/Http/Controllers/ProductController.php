<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return ProductResource::collection(Product::with('categories', 'images')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $categories = [];
        $images = [];
        if (isset($validated['categories'])) {
            $categories = $validated['categories'];
            unset($validated['categories']);
        }

        if (isset($validated['images'])) {
            $images = $validated['images'];
            unset($validated['images']);
        }

        $product = Product::create($validated);
        $product->categories()->sync($categories);
        $product->images()->sync($images);
        $product->load('categories', 'images');

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('categories', 'images');
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->enable = $validated['enable'];
        $product->save();
        if (isset($validated['categories'])) {
            $categories = $validated['categories'];
            unset($validated['categories']);
            $product->categories()->sync($categories);
        }

        if (isset($validated['images'])) {
            $images = $validated['images'];
            unset($validated['images']);
            $product->images()->sync($images);
        }

        $product->load('categories', 'images');
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->categories()->detach();
        $product->images()->detach();
        $product->delete();
        return ['message' => 'resource deleted'];
    }
}
