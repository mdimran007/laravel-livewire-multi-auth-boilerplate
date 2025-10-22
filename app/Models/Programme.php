<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = [
        'images',
        'title',
        'slug',
        'short_description',
        'description',
        'url',
        'status',
        'created_by'
    ];

    public function goals()
    {
        return $this->belongsToMany(Goal::class, 'goal_programme');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($data) {
            $data->slug = Str::slug($data->title);
        });
    }
}
