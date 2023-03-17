<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return ImageResource::collection(Image::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $image = $request->validated();
        $filePath = $request->file('file')->store('images');
        $image['file'] = $filePath;
        return new ImageResource(Image::create($image));
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        return new ImageResource($image);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        $validated = $request->validated();
        $image->name = $validated['name'];
        $image->file = $validated['file'];
        $image->enable = $validated['enable'];
        $image->save();
        return new ImageResource($image);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $image->delete();
        return ['message' => 'resource deleted'];
    }
}
