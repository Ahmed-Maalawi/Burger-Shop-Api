<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meal\MealRequest;
use App\Models\Meal;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'get all meals',
            'data' => Meal::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MealRequest $request)
    {
        $validated = $request->validated();

        $attributes['name'] = [
            'en' => $validated['name']['en'],
            'ar' => $validated['name']['ar'],
        ];

        $attributes['description'] = [
            'en' => $validated['desc']['en'],
            'ar' => $validated['desc']['ar'],
        ];

        $attributes['price'] = $validated['price'];
        $attributes['discount'] = $validated['discount']?? null;


        $attributes['category_id'] = $validated['category_id'];

        $meal = Meal::create($attributes);

        return response()->json([
            'status' => 'success',
            'message' => 'meal created',
            'data' => $meal
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'get meals details',
            'data' => Meal::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MealRequest $request, string $id)
    {
        $validated = $request->validated();

        $attributes['name'] = [
            'en' => $validated['name']['en'],
            'ar' => $validated['name']['ar'],
        ];

        $attributes['description'] = [
            'en' => $validated['desc']['en'],
            'ar' => $validated['desc']['ar'],
        ];

        $attributes['price'] = $validated['price'];
        $attributes['discount'] = $validated['discount']?? null;

        $attributes['category_id'] = $validated['category_id'];

        $meal = Meal::findOrFail($id);

        $meal->update($attributes);

        return response()->json([
            'status' => 'success',
            'message' => 'meal updated',
            'data' => $meal
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $meal = Meal::findOrFail($id);

//      -------- delete meal images from storage  ---------------

        $meal->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'meal deleted'
        ]);
    }
}
