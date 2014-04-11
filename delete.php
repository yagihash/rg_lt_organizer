<?php
require_once (__DIR__ . "/common.php");
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
if($isAuthed){
  $wid = (isset($_GET["id"]) and !is_array($_GET["id"])) ? $_GET["id"] : false;
  if($_GET["id"]){
    $talk = Talk::where("id",$_GET["id"])->where("user_id",$current_user->id)->find_one();
    if($talk !== false){
      $token = postParamValidate("token");
      $saved = false;
      if(checkToken($token)){
        $talk->delete();
        $saved = true;
      }
      if($saved){
?>
      <h1>Deleted</h1>
<?php
      }else{
      //OK
?>
      <h1>本当に削除してよろしいですか？</h1>
      <form id="register" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
        <input type="submit" value="Delete" />
      </form>
<?php
      }
    } else {
      //notfound id or not create user
    
    }
  }
}
?>
      
      </div>
    </div>
  </body>
</html>