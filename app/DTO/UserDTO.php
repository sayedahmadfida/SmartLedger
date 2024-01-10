<?php
namespace App\DTO;


class UserDTO{

  public $request;

  public function __construct($request){
    $this->request = $request->all();
  }

}


?>