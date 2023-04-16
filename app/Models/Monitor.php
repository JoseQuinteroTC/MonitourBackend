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
        'phone_number',
        'url_img_profile',
    ];

    protected $casts = [
        'phone_number' => 'integer',
    ];

}
