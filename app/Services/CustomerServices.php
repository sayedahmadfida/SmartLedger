<?php
namespace App\Services;

use App\Models\Business;
use App\Models\Sale_invoice;
use App\Models\Money_resourses;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer_declearation;
use App\Models\Customer_invoice_paid;
use Illuminate\Support\Facades\Crypt;

class CustomerServices{

  public function createBusiness($request){
    
    return Business::create([
        'business_name' => $request->name,
        'business_country' =>$request->country,
        'business_province' => $request->province,
        'business_state'  => $request->state,
        'business_type' => $request->type, 
        'identity_card' => $request->identity_card,
        'business_status' => 1, 
        'user_id' => session('user.id'), 
        'admin_id' => session('user.admin_id')
    ]);
  }

  public function createCustomerDeclearation($customerId){
    
    Customer_declearation::create([
      'customer_id' => $customerId,
      'currency_id' => session('user.currency_id'),
      'user_id' => session('user.id'),
      'admin_id' => session('user.admin_id'),
    ]);
  }



  public static function businessUpdate($request, $id){
     Business::where('id', $id)
      ->where('admin_id', session('user.admin_id'))
      ->withTrashed()
      ->update([
        'business_name' => $request->name,
        'business_country' =>$request->country,
        'business_province' => $request->province,
        'business_state'  => $request->state,
        'business_type' => $request->type, 
        'identity_card' => $request->identity_card, 
      ]);
}

 

}




?>