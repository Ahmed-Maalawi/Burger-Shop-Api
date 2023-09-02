<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\SliderRequest;
use App\Http\Requests\Slider\UpdateSliderImgRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:admin-api']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'get all sliders',
            'data' => Slider::latest()->filter(request(['search']))
                ->paginate(9)
                ->appends('search')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $validated = $request->validated();

        $attributes['title'] = [
            'en' => $validated['title_en'],
            'ar' => $validated['title_ar']
        ];

        $attributes['description'] = [
            'en' => $validated['title_en'],
            'ar' => $validated['title_ar']
        ];

        $attributes['link'] = $validated['link'];

        $attributes['image'] = request()->file('slider_img')
            ->store('slider');

        $slider = Slider::create($attributes);

        return response()->json([
            'status' => 'success',
            'message' => 'slider created',
            'data' => $slider
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $slider = Slider::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'slider details',
            'data' => $slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, string $id)
    {
        $validated = $request->validated();

        $slider = Slider::findOrFail($id);

        $attributes['title'] = [
            'en' => $validated['title_en'],
            'ar' => $validated['title_ar']
        ];

        $attributes['description'] = [
            'en' => $validated['description_en'],
            'ar' => $validated['description_ar']
        ];

        $attributes['link'] = $validated['link'];

        $slider->update($attributes);

        return response()->json([
            'status' => 'success',
            'message' => 'slider details',
            'data' => $slider
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);

        Storage::delete($slider['image']);

        $slider->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'slider deleted'
        ]);
    }

    public function updateImage(UpdateSliderImgRequest $request,string $id)
    {
        $request->validated();

        $slider = Slider::findOrFail($id);

        $img = $slider['image'];

        if (Storage::exists($img))
        {
            Storage::delete($img);
        }

        $attribute['image'] = $request->file('slider_img')
            ->store('slider');

        $slider->update($attribute);

        return response()->json([
            'status' => 'success',
            'message' => 'slider image updated'
        ]);
    }
}
