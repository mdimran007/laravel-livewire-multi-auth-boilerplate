<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoalAsset extends Model
{
   protected $fillable = [
        'goal_id',
        'asset_type',
        'data',
        'created_by',
        'status',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
