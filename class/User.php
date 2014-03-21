<?php

class User extends Model{
  public static $_table = 'users';

  public function talks (){
    return $this->has_many('Talk');
  }

  public function kg(){
    return $this->belongs_to('KG');
  }

}
