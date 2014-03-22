<?php

class User extends Model{
  public static $_table = 'users';

  public function talks (){
    return $this->has_many('Talk');
  }

  public function kg(){
    return $this->belongs_to('KG');
  }
  
  public function year(){
    return $this->belongs_to('Year');
  }
  
  public function isAdmin(){
    return ($this->login_name == "kazu1130" ||
            $this->login_name == "yagihash");
  }

}
