<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ResetPassword extends Authenticatable
{
    use HasFactory;

    protected $table = 'password_resets';
    protected $fillable = [
        'full_name',
        'birth_date',
        'phone_number',
        'account_type',
        'gender',
        'image',
        'email',
        'password',
        'code',
        'created_at',
    ];
}