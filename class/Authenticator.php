<?php

class Authenticator {
   public function passwordAuth($login_name,$password){
     $user = User::where('login_name',$login_name)->find_one();
     if($user === false){
       //LDAP 
       // $ldap_user = $this->ldap_pass($login_name,$password);
       $ldap_user = null;
       if(is_null($ldap_user)){
         return false;
       }
       // $this->makeUser($ldap_user);
     }
     return $user;
   }
}
