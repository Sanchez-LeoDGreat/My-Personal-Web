<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'icon_path',
        'about',
        'summary',
        'description',
        'downloadable'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
