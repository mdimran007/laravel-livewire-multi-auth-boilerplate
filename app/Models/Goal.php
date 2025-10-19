<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Goal extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'images',
        'achievements',
        'status',
        'created_by',
    ];

    protected $casts = [
        'achievements' => 'array',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($goal) {
            $goal->slug = Str::slug($goal->title);
        });
    }
}
