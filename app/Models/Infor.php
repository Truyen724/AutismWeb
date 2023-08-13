<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infor extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'id',
        'user_id',
        'token',
        'created_at',
    ];
}
