<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'course',
        'monitor',
        'idMonitor',
        'price',
        'description',
        'modality',
        'views',
        'request',
        'url_img_profile',

    ];

}
