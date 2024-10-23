<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $fillable = [
        'section_id',
        'service_type_id',
        'service_name',
        'service_price',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ServiceImage::class, 'service_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id', 'id');
    }

    public function rates()
    {
        return $this->hasMany(UserRate::class, 'service_id', 'id');
    }
}