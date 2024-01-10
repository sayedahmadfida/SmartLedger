<?php
namespace App\Services;
use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class UserManagementServices{

  public function userStatus($id, $type){
    
    return User::where('admin_id', session('user.admin_id'))
      ->where('id', $id)
      ->where('id', '!=', session('user.id'))
      ->update([
          'status'=> $type
      ]);
  }

  public function createUser(UserDTO $userDTO): User{
      $user_details = $userDTO->request;

      return User::create([
        'f_name' => $user_details['first_name'],
        'l_name' => $user_details['last_name'],
        'default_password' => $user_details['first_name'],
        'user_id' => session('user.id'),
        'email' => $user_details['email'],
        'username' => $user_details['username'],
        'type' => 'USERS',
        'status' => 1,
        'admin_id' => session('user.admin_id'),
        'password' => Hash::make($user_details['new_password']),
    ]);

  }
}


?>