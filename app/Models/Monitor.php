<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;

class Monitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'lastName',
        'email',
        'description',
        'phone_number',
        'document',
        'url_img_profile',
    ];

    protected $casts = [
        'phone_number' => 'integer',
    ];
}
