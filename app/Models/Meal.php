<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Meal extends Model
{
    use HasFactory, HasSlug;

//    protected $with = ['Category', 'Thumniles'];

    protected $casts = [
        'name' => 'json',
        'description' => 'json',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Images()
    {
        return $this->hasMany(MealImg::class, 'meal_id', 'id');
    }

    public function Thumniles()
    {
        $thumbnil = $this->Images()->first();

        return $thumbnil? $thumbnil['img_path'] : null;
    }


    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function ($model){
                return $model->name['en'];
            })
            ->saveSlugsTo('slug');
    }
}
