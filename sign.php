<?php
require_once (__DIR__ . "/common.php");

$mode = $_GET["mode"];

if($mode == "check"){
  $login_name = (isset($_GET["login_name"]) and !is_array($_GET["login_name"])) ? $_GET["login_name"] : "";
  $mail_hash = (isset($_GET["mail_hash"]) and !is_array($_GET["mail_hash"])) ? $_GET["mail_hash"] : "";

  $current_user = User::where("login_name",$login_name)->where("mail_auth",0)->where("mail_hash",$mail_hash)->find_one();
  if($current_user !== false){
    $current_user->mail_auth = 1;
    $current_user->save();
    session_regenerate_id(true);
    $_SESSION["name"] = $current_user->login_name;
    $_SESSION["current_id"] = $current_user->id;
    header("Location: {$base_url}");
    die("");
  }
}

?>
<!DOCTYPE html>

<html lang="ja">
  <head>
<?php
require_once (__DIR__ . "/head.php");
?>
  </head>

  <body>
<?php
require_once(__DIR__ . "/top_bar.php");
?>
    <div id="wrap">
<?php
require_once(__DIR__ . "/page_header.php");
?>
      <div id="main" class="content">
<?php
  $token = postParamValidate("token");
  $saved = false;
  if(checkToken($token)){
    $login_name = postParamValidate("login_name");
    $screen_name = postParamValidate("screen_name");
    $password = postParamValidate("password");
    $kg_id = postParamValidate("kg");
    $year_id = postParamValidate("year");
    
    // 整合性チェック
    $kg = KG::find_one($kg_id);
    $year = Year::find_one($year_id);
    
    $error = array();
    if($kg === false){
      $error[] = "KGが登録されていません.";
    }
    if($year === false){
      $error[] = "学年が登録されていません.";
    }
    if(preg_match("/\A[a-zA-Z0-9]{1,8}\z/",$login_name) !== 1){
      $error[] = "ログイン名が不正です.".preg_match("/\A[a-zA-Z0-9]{1,8}\z/",$login_name).$login_name;
    }
    if($screen_name === false){
      $error[] = "スクリーンネームが不正です.";
    }
    if(strlen($password) < 4){
      $error[] = "パスワードは4文字以上の長さが必要です.";
    }
    
    if(count($error) === 0){
      $fuser = User::where("login_name",$login_name)->find_one();
      if($fuser === false){
        $newuser = User::create();
        $hashcode = sha1(bin2hex(openssl_random_pseudo_bytes(32)));
        $newuser->login_name = $login_name;
        $newuser->screen_name = $screen_name;
        $newuser->password = hashPassword($password);
        $newuser->kg_id = $kg_id;
        $newuser->year_id = $year_id;
        $newuser->mail_auth = 0;
        $newuser->mail_hash = $hashcode;
        $newuser->save();
        mb_send_mail($login_name."@sfc.wide.ad.jp",
             "LT Systemへの登録",
             "RG LT登録システムへの認証を行います。以下のページへアクセスしてください。\n\n".((empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"])."?mode=check&login_name=".$login_name."&mail_hash=".$hashcode,
             "From: rg-coordinator@sfc.wide.ad.jp\nContent-Type: text/plain; charset=\"ISO-2022-JP\";\n"
        );
      }
?>
        <h2>仮登録しました。</h2>
        <p>まだ登録は済んでいません。wideのアドレスで認証する必要があります。</p>
        <p><?php echo escapeHTML($login_name); ?>@sfc.wide.ad.jpにメールを送りました。</p>
        <p>確認して下さい。</p>
<?php
    }else{
?>
        <h2>LT System登録フォーム</h2>
        <p>{Login name}@sfc.wide.ad.jpに認証用メールを送ります。</p>
<?php
      foreach($error as $err){
        echo "        <p>".escapeHTML($err)."</p>\n";
      }
?>
        <form id="signup" method="POST">
          <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
          <label><span>Login name:</span><input type="text" name="login_name" placeholder="Ex.) nakajima" value="<?php echo escapeHTML($login_name); ?>" maxlength="8" /></label>
          <label><span>Password:</span><input type="password" name="password"/></label>
          <label><span>Screen name:</span><input type="text" name="screen_name" value="<?php echo escapeHTML($screen_name); ?>" placeholder="Ex.) ナカジマ" maxlength="20"/></label>
          <label><span>KG:</span><select name="kg" required>
<?php
  $kgs = KG::find_many();
  foreach($kgs as $kg){
    echo "              <option value=\"".escapeHTML($kg->id)."\"".($kg_id == $kg->id?" selected":"").">".escapeHTML($kg->name)."</option>\n";
  }
?>
          </select></label>
          <label><span>Year:</span><select name="year" required><!-- TODO: 一度登録すると以降は勝手にKGと学年選んでくれるように -->
<?php
  $years = Year::order_by_asc("id")->find_many();
  foreach($years as $year){
    echo "              <option value=\"".escapeHTML($year->id)."\"".($year->id == $year_id?" selected":"").">\n".escapeHTML($year->name)."</option>\n";
  }
?>
          </select></label>
          <input type="submit" value="Submit" />
        </form>
<?php
    }
  }else {
?>
        <h2>LT System登録フォーム</h2>
        <p>{Login name}@sfc.wide.ad.jpに認証用メールを送ります。</p>
        <form id="signup" method="POST">
          <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
          <label><span>Login name:</span><input type="text" name="login_name" placeholder="Ex.) nakajima" maxlength="8" /></label>
          <label><span>Password:</span><input type="password" name="password"/></label>
          <label><span>Screen name:</span><input type="text" name="screen_name" placeholder="Ex.) ナカジマ" maxlength="20"/></label>
          <label><span>KG:</span><select name="kg" required>
<?php
  $kgs = KG::find_many();
  foreach($kgs as $kg){
    echo "              <option value=\"".escapeHTML($kg->id)."\">".escapeHTML($kg->name)."</option>\n";
  }
?>
          </select></label>
          <label><span>Year:</span><select name="year" required>
<?php
  $years = Year::order_by_asc("id")->find_many();
  foreach($years as $year){
    echo "              <option value=\"".escapeHTML($year->id)."\">".escapeHTML($year->name)."</option>\n";
  }
?>
          </select></label>
          <input type="submit" value="Submit" />
        </form>
<?php
  }
?>
      </div>
    </div>
  </body>
</html>
