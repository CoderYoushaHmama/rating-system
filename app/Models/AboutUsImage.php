<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsImage extends Model
{
    use HasFactory;

    protected $table = 'about_us_images';
    protected $fillable = [
        'image'
    ];
}