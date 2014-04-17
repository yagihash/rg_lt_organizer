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
        $title = postParamValidate("title");
        $week_id = postParamValidate("date");
        $filename = sha1($_FILES["slide"]["tmp_name"] . bin2hex(openssl_random_pseudo_bytes(32)) . time()) . ".pdf";
        $filepath =  "slides/" . $filename;
        $week = LtWeek::where_raw("date > ?",array(date('Y-m-d H:i:s')))->find_one($week_id);
        if($title !== false && $week !== false && is_uploaded_file($_FILES["slide"]["tmp_name"])){
          $talk->lt_week_id = $week_id;
          $talk->title = $title;
          if (move_uploaded_file($_FILES["slide"]["tmp_name"], $filepath)) {
            chmod($filepath, 0644);
          } else {
            echo "Unkown Error";
            exit();
          }
          $talk->slide = $filename;
          $talk->save();
          $saved = true;
        }
      }
      if($saved){
?>
      <h1>Saved</h1>
<?php
      }else{
      //OK
?>
      <form id="register" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
        <label><span>Date:</span><select name="date" required>
<?php
        $lt_weeks = LtWeek::where_raw("date >= ?",array(date('Y-m-d H:i:s')))->order_by_asc("week")->find_many();
        foreach($lt_weeks as $lt_week){
          echo "            <option value=\"".escapeHTML($lt_week->id). (($lt_week->id == $talk->week_id)?" selected":"") . "\">第".escapeHTML($lt_week->week)."回目(".escapeHTML($lt_week->date).")</option>\n";
        }
?>
        </select></label>
        <label><span>Title:</span><input type="text" name="title" value="<?php echo escapeHTML($talk->title); ?>" maxlength="100" required /></label>
        <label><span>Slides:</span><input type="file" name="slide" accept="application/pdf" /></label>
        <label class="check">スライドを非公開に設定する<input type="checkbox" name="publish_slide" /></label>
        <input type="submit" value="Submit" />
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