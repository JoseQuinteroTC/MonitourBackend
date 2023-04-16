<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;
class Monitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'phoneNumber',
        'url_img_profile',
    ];

    protected $casts = [
        'phoneNumber' => 'integer',
    ];

}
