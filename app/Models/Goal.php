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
        'sdg_image',
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

    public function getAchievementCountsAttribute()
    {
        $allTypes = [
            'policies' => 'Policy',
            'services' => 'Services',
            'programmes' => 'Programmes',
            'facilities' => 'Facilities',
            'events' => 'Events',
            'researches' => 'Research',
            'reports' => 'Report',
            'news' => 'News',
            'partnerships' => 'Partnerships',
        ];

        $achievements = $this->achievements;

        if (is_string($achievements)) {
            // First decode (removes outer quotes)
            $achievements = json_decode($achievements, true);
            // If still a string, decode again
            if (is_string($achievements)) {
                $achievements = json_decode($achievements, true);
            }
        }

        // Ensure we have an array
        $achievements = is_array($achievements) ? $achievements : [];

        $counts = [];

        foreach ($allTypes as $key => $label) {
            if (in_array($key, $achievements)) {
                $counts[$label] = $this->{$key . '_count'} ?? 0;
            }
        }

        return $counts;
    }

    public function committeeMembers()
    {
        return $this->belongsToMany(CommitteeMember::class, 'committee_member_goal');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function policies()
    {
        return $this->belongsToMany(Policy::class, 'goal_policy')->withTimestamps();
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'goal_service')->withTimestamps();
    }

    public function programmes()
    {
        return $this->belongsToMany(Programme::class, 'goal_programme')->withTimestamps();
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'goal_facility')->withTimestamps();
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'goal_event')->withTimestamps();
    }

    public function researches()
    {
        return $this->belongsToMany(Research::class, 'goal_research')->withTimestamps();
    }

    public function reports()
    {
        return $this->belongsToMany(Report::class, 'goal_report')->withTimestamps();
    }

    public function news()
    {
        return $this->belongsToMany(News::class, 'goal_news')->withTimestamps();
    }

    public function partnerships()
    {
        return $this->belongsToMany(Partnership::class, 'goal_partnership')->withTimestamps();
    }
}
