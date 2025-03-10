<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Downloadable extends Model
{
    protected $fillable = [
        'project_id',
        'version',
        'what_is_new',
        'download_path',
        'download_count',
    ];
}
