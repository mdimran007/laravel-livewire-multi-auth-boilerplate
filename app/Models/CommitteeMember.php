<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommitteeMember extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'designation', 'url', 'picture', 'status', 'created_by'];

    protected $casts = [
        'selectedGoals' => 'array', // convert JSON to array
    ];

    public function goals()
    {
        return $this->belongsToMany(Goal::class, 'committee_member_goal');
    }
}
