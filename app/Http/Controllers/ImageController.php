<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return ImageResource::collection(Image::with('products')->paginate());
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        $image->load('products');

        return new ImageResource($image);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        $validated = $request->validated();
        $path = $request->file('file')->store('images');
        Storage::delete($image->file);
        $image->name = $validated['name'];
        $image->file = $path;
        $image->enable = $validated['enable'];
        $image->save();
        if (isset($validated['products'])) {
            $products = $validated['products'];
            unset($validated['products']);
            $image->products()->sync($products);
        }

        $image->load('products');
        return new ImageResource($image);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $validated = $request->validated();
        $path = $request->file('file')->store('images');
        $validated['file'] = $path;
        $products = [];
        if (isset($validated['products'])) {
            $products = $validated['products'];
            unset($validated['products']);
        }

        $image = Image::create($validated);
        $image->products()->sync($products);
        $image->load('products');
        return new ImageResource($image);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        Storage::delete($image->file);
        $image->products()->detach();
        $image->delete();
        return ['message' => 'resource deleted'];
    }
}
