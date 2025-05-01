<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'rating',
        'comment',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
