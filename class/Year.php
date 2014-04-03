<?php

class Year extends Model{
  public static $_table = 'years';

  public function members(){
    return $this->has_many('Users','user_id')->find_many();
  }
}