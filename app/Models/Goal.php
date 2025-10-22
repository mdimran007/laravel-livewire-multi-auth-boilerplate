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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function policies()
    {
        return $this->belongsToMany(Policy::class, 'goal_policy');
    }
    public function services()
    {
        return $this->belongsToMany(Service::class, 'goal_service');
    }
    public function programmes()
    {
        return $this->belongsToMany(Programme::class, 'goal_programme');
    }
    public function events()
    {
        return $this->belongsToMany(Event::class, 'goal_event');
    }
    public function partnerships()
    {
        return $this->belongsToMany(Partnership::class, 'goal_partnership');
    }
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'goal_facility');
    }
    public function researches()
    {
        return $this->belongsToMany(Research::class, 'goal_research');
    }
    public function reports()
    {
        return $this->belongsToMany(Report::class, 'goal_report');
    }
    public function news()
    {
        return $this->belongsToMany(News::class, 'goal_news');
    }
}
