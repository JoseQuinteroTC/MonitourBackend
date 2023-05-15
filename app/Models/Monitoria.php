<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'course',
        'idMonitor',
        'price',
        'description',
        'monitor',

    ];
    
}
