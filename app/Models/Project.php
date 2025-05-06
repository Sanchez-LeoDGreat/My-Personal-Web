<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'icon_path',
        'previews',
        'about',
        'summary',
        'description',
        'downloadable',
        'view_count',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function downloadables()
    {
        return $this->hasMany(Downloadable::class)->latest();
    }
}
