<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $casts = [
        'title' => 'json',
        'description' => 'json'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search']?? false, fn($query, $search) =>
            $query->when(fn($query) =>
                $query->where('title->en', 'like', '%'. request('search') . '%')
                    ->orWhere('title->ar', 'like','%' . request('search') . '%')
            )
        );
    }
}
