<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
class UserAvatar extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'userAvatar',
        'user_id',
        'admin_id'
    ];
    public static function createAvatar($imageName){
        UserAvatar::create([
            'userAvatar' => $imageName,
            'user_id' => session('user.id'),
            'admin_id' => session('user.admin_id'),
        ]);
    }
    public static function updateAvatar($imageName){
        return  UserAvatar::where('user_id', Auth::id())
        ->update([
            'userAvatar' => $imageName,
        ]);
    }
}
