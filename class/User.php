<?php

class User extends Model{
  public static $_table = 'users';

  public function talks (){
    return $this->has_many('Talk','talk_id')->find_many();
  }

  public function kg(){
    return $this->belongs_to('KG','kg_id')->find_one();
  }
  
  public function year(){
    return $this->belongs_to('Year','year_id')->find_one();
  }
  
  public function isAdmin(){
    return ($this->login_name == "kazu1130" ||
            $this->login_name == "yagihash");
  }

}
