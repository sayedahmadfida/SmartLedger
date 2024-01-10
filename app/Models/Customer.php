<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
   
    protected $fillable = [
        'customer_name',
        'customer_country',
        'customer_province',
        'customer_state',
        'customer_type', 
        'identity_card',
        'customer_status', 
        'user_id', 
        'admin_id'
    ];

    public static function createCustomer($request){
    
        return Customer::create([
            'customer_name' => $request->name,
            'customer_country' =>$request->country,
            'customer_province' => $request->province,
            'customer_state'  => $request->state,
            'identity_card' => $request->identity_card,
            'customer_status' => 1, 
            'user_id' => session('user.id'), 
            'admin_id' => session('user.admin_id')
        ]);
      }


      public static function customerUpdate($request, $id){
        return Customer::where('id', $id)
         ->where('admin_id', session('user.admin_id'))
         ->withTrashed()
         ->update([
           'customer_name' => $request->name,
           'customer_country' =>$request->country,
           'customer_province' => $request->province,
           'customer_state'  => $request->state,
           'identity_card' => $request->identity_card, 
         ]);
   }


}

