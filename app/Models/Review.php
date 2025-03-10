<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'project_id',
        'first_name',
        'last_name',
        'rating',
        'review',
    ];
}
