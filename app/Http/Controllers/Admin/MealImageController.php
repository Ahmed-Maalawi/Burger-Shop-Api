<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meal\MealImageRequest;
use App\Models\MealImg;
use Illuminate\Http\Request;

class MealImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'get all meal images',
            'data' => MealImg::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MealImageRequest $request)
    {
        $request->validated();

        $attributes['meal_id'] = $request['meal_id'];

        $images = $request->file('images');

        foreach ($images as $image) {
            $attributes['img_path'] = $image->store('meal-images');

            MealImg::create($attributes);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'meal images added',
            'data' => $images
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'meal images added',
            'data' => MealImg::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MealImageRequest $request, string $id)
    {
        $request->validated();

        $img = MealImg::findOrFail($id);
        $img->update([
            'meal_id' => $request['meal_id']
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'meal image updated',
            'data' => $img,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $img = MealImg::findOrFail($id);

        $img->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'meal image deleted',
        ]);
    }
}
