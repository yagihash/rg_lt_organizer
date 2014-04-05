<?php

class LtWeek extends Model{
  public static $_table = 'lt_weeks';
  
  public function talks (){
    return $this->has_many('Talk','lt_week_id')->order_by_acs("order")->find_many();
  }
  
}