<?php

class LtWeek extends Model{
  public static $_table = 'lt_weeks';
  
  public function talks (){
    return $this->has_many('Talk','lt_week_id')->order_by_asc("order")->order_by_asc("id")->find_many();
  }
  
  public function getRecent(){
    return false;
//    return self::raw_query('SELECT * FROM lt_weeks ORDER BY abs(cast(CURDATE() as SIGNED) - cast(date as SIGNED)) LIMIT 1')->find_one();
  }
  
  public function getNext(){
    return self::raw_query('SELECT * FROM lt_weeks WHERE date >= ? ORDER BY date LIMIT 1',array(date('Y-m-d H:i:s')))->find_one();
  }
  
  public function getPasts(){
    return self::raw_query('SELECT * FROM lt_weeks WHERE date < ? ORDER BY week',array(date('Y-m-d H:i:s')))->find_many();
  }
  
}