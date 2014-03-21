<?php

class Talk extends Model{
  public static $_table = 'talks';
  
  public function user(){
    return $this->belongs_to('User');
  }
  
  public function week(){
    return $this->belongs_to('LtWeek');
  }

}