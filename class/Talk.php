<?php

class Talk extends Model{
  public static $_table = 'talks';
  
  public function user(){
    return $this->belongs_to('User','user_id')->find_one();
  }
  
  public function week(){
    return $this->belongs_to('LtWeek','lt_week_id')->find_one();
  }

}