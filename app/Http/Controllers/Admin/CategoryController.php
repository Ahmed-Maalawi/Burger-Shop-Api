<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Category\updateCategoryImgRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-api');
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'get all categories',
            'data' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();

        $attributes['name'] = $validated['name'];

        $attributes['img_path'] = $request->file('category_img')->store('categories');

        $category = Category::create($attributes);

        return response()->json([
            'status' => 'success',
            'message' => 'category created',
            'data' => $category,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(string $id)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'get category details',
            'data' => Category::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $validated = $request->validated();

        $attributes['name'] = $validated['name'];

        $category = Category::findOrFail($id);

        $newImg = $request->file('category_img')?? null;

        if ($newImg){ $attributes['img_path'] = $this->updateImg($newImg, $category); }

        $category->update($attributes);

        return response()->json([
            'status' => 'success',
            'message' => 'category updated',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        unlink($category['img_path']);

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'category deleted'
        ]);
    }


    public function updateCategoryImg(updateCategoryImgRequest $request, string $id)
    {
        $request->validated();

        $img = $request->file('category_img');

        $category = Category::findOrFail($id);

        $attributes['img_path'] = $this->updateImg($img, $category);

        $category->update($attributes);

        return response()->json([
            'status' => 'success',
            'message' => 'category image updated',
            'data' => $category,
        ]);
    }

    public function updateImg($newImg, Category $category)
    {
        if ($category['img_path'])
        {
            unlink($category['img_path']);
        }

        return $newImg->store('categories');
    }
}
