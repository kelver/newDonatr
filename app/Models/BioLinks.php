<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioLinks extends Model
{
    use HasFactory;

    protected $table = 'bio_links';

    protected $fillable = [
        'uuid',
        'url',
        'title',
        'status',
        'user_id',
    ];
}
