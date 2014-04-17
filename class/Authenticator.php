<?php

class Authenticator {
  const LDAP_SERVER = "ldaps://ldap1.sfc.wide.ad.jp/";
  const DEBUG_FLAG = false;
  public function passwordAuth($login_name, $password) {
    if (false) {
      return $this -> dbAuth($login_name, $password);
    } else {
      return $this -> ldapAuth($login_name, $password);
    }
  }

  public function ldapAuth($login_name, $password) {
    $ldap_auth = $this -> ldap_pass($login_name, $password);
    //LDAPのパスとマッチするかどうか
    if ($ldap_auth) {
      $user = User::where('login_name', $login_name) -> find_one();
      //ユーザが居た
      if ($user !== false) {
        return $user;
      } else {
        //ユーザが居ないから作る
        return $this -> makeUser($login_name);
      }
    } else {
      return false;
    }
  }

  public function ldap_pass($login_name, $password) {
    $ldapconn = ldap_connect(self::LDAP_SERVER);
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
    if ($ldapconn) {
      $ldapbind = false;
      if(preg_match("/\A[a-zA-Z0-9_]+\z/",$login_name)){
        $ldapbind = ldap_bind($ldapconn, "uid={$login_name},ou=People,dc=sfc,dc=wide,dc=ad,dc=jp", $password);
      }
      if ($ldapbind) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function dbAuth($login_name, $password) {
    $user = User::where('login_name', $login_name) -> find_one();
    if(DEBUG_FLAG){
      return User::where('login_name', $login_name) -> find_one();
    }
    if ($user === false) {
      return false;
    }
    if (checkPassword($password, $user -> password)) {
      return $user;
    } else {
      return false;
    }
  }

  public function makeUser($login_name) {
    $user = User::create();

    $user -> login_name = $login_name;
    $user -> screen_name = $login_name;
    $user-> kg_id = 1;
    $user -> year_id = 1;
    $user -> save();

    return $user;
  }

}

/*
 ou=People,dc=sfc,dc=wide,dc=ad,dc=jp
 $a1 = new Auth("LDAP", array(
 'host' => 'ldap1.sfc.wide.ad.jp',
 'port' => '389',
 'version' => 3,
 'basedn' => 'dc=sfc,dc=wide,dc=ad,dc=jp',
 'userattr' => $login_name,
 'binddn' => "uid={$login_name},ou=People,dc=sfc,dc=wide,dc=ad,dc=jp",
 'bindpw' => $password
 ));

 */
