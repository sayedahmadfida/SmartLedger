<?php

namespace App\Models;

use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'user_id',
        'admin_id',
        'model_id',
    ];
    public static function createPhone($phone, $modelId)
    {

        return Phone::create([
            'phone' => $phone,
            'model_id' => $modelId,
            'user_id' => session('user.id'),
            'admin_id' => session('user.admin_id'),
        ]);
    }

    public static function updatePhone($phone, $id)
    {
        return Phone::where('id', $id)
        ->where('admin_id', session('user.admin_id'))
        ->update([
            'phone' => $phone
        ]);
    }



}
