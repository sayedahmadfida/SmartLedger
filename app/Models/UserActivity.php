<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'activity_description',
        'user_id',
        'admin_id',
    ];



    public static function createActivity($description){
        return UserActivity::create([
            'full_name' => session('user.first_name').' ( '. session('user.last_name'). ' )',
            'activity_description' => $description,
            'user_id' => session('user.id'),
            'admin_id' => session('user.admin_id'),
        ]);
    }
}
