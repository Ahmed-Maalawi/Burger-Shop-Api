<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealImg extends Model
{
    use HasFactory;

    public function Meal()
    {
        return $this->belongsTo(Meal::class);
    }
}
