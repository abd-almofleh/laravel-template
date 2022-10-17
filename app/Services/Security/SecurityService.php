<?php

namespace App\Services\Security;

class SecurityService
{
  public $authentication;

  public function __construct()
  {
    $this->authentication = new Authentication();
  }
}
