<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class User_info extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'user_country',
        'user_province',
        'user_address',
        'user_invoice_address'
    ];
    public static function createUserInfo(array $request)
    {
        // dd($request);
        return user_info::create([
            'user_id'=> Auth::id(), 
            'user_country' => $request['userCountry'],
            'user_province' => $request['userProvince'],
            'user_address' => $request['userAddress'],
            'user_invoice_address' => $request['invoiceAddress']
        ]);
    }
    
    public static function updateUserInfo(array $request, $userid)
    {
        user_info::where('id', Crypt::decrypt($userid))
        ->where('user_id', Auth::id())
        ->update([
            'user_country' => $request['userCountry'],
            'user_province' => $request['userProvince'],
            'user_address' => $request['userAddress'],
            'user_invoice_address' => $request['invoiceAddress']
        ]);
        
    }
}
