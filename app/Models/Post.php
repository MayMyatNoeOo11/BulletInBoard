<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'type',
        'phone',
        'address',
        'date_of_birth',
        'created_user_id',
        'updated_user_id',
        'deleted_user_id'
    ];
}
