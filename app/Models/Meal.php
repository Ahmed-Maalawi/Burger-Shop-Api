<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

//    protected $with = ['Category', 'Thumniles'];

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
}
