<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_error extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  
  public function returnError($errorCode,$errorMessage){
    $error = Array(
      'errorCode' => $errorCode,
      'errorMessage' => $errorMessage
    );
    return json_encode($error);
  }

}
