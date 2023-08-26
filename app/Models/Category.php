<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


//    protected $with = ['Meals'];

    public function Meals()
    {
        return $this->hasMany(Meal::class);
    }
}