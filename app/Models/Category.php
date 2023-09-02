<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory, HasSlug;

    protected $casts = [
        'name' => 'json'
    ];
//    protected $with = ['Meals'];

    public function scopeFilter($query, array $filters)
    {
//      -----------------------  search filter  --------------------------
        $query->when($filters['search']?? false, fn($query, $search) =>
            $query->when(fn($query) =>
                $query->where('name->en', 'like','%' . request('search') . '%')
                    ->orWhere('name->ar', 'like','%' . request('search') . '%')
                    ->orWhere('slug', 'like', '%' . request('search') . '%')
            )
        );
    }

    public function Meals()
    {
        return $this->hasMany(Meal::class);
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
