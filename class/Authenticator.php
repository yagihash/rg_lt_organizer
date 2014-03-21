<?php

class Authenticator {
   public function passwordAuth($login_name,$password){
     $user = User::where('login_name',$login_name)->find_one();
     if(is_null($user)){
       //LDAP 
       // $ldap_user = $this->ldap_pass($login_name,$password);
       // $this->makeUser($ldap_user);
     }
     return $user;
   }
}
