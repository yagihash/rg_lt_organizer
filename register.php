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
require_once (__DIR__ . "/top_bar.php");
?>
    <div id="wrap">
<?php
require_once (__DIR__ . "/page_header.php");
?>
      <div id="main" class="content">
<?php
if($isAuthed) {
  $token = postParamValidate("token");
  $saved = false;
  if(checkToken($token)){
    $title = postParamValidate("title");
    $sname = postParamValidate("screen");
    $week_id = postParamValidate("date");
    $kg_id = postParamValidate("kg");
    $year_id = postParamValidate("year");
    
    // 整合性チェック
    $kg = KG::find_one($kg_id);
    $year = Year::find_one($year_id);
    $week = LtWeek::where_raw("date > ?",array(date('Y-m-d H:i:s')))->find_one($week_id);

    // TODO: PDFかどうかをチェックする
    $filename = sha1($_FILES["slide"]["tmp_name"] . bin2hex(openssl_random_pseudo_bytes(32)) . time()) . ".pdf";
    $filepath =  "slides/" . $filename;
    if($title !== false && $week !== false && $kg !== false && $year !== false && is_uploaded_file($_FILES["slide"]["tmp_name"])){
      // ユーザ情報の保存
      $need_save = false;
      if($current_user->kg_id != $kg_id){
        $current_user->kg_id = $kg_id;
        $need_save = true;
      }
      if($current_user->year_id != $year_id){
        $current_user->year_id = $year_id;
        $need_save = true;
      }
      if($current_user->screen_name !== $sname){
        $current_user->screen_name = $sname;
        $need_save = true;
      }

      if($need_save){
        $current_user->save();
      }
      
      // LTデータ保存
      $talk = Talk::create();
      $talk->user_id = $current_user->id;
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
        <h2>Register</h2>
        <h3>登録しました。</h3>
        <a href="mypage.php">マイページへ</a>
<?php
  }else{
?>
        <h2>Register</h2>
        <form id="register" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
          <label><span>Date:</span><select name="date" required>
<?php
  $lt_weeks = LtWeek::where_raw("date >= ?",array(date('Y-m-d H:i:s')))->order_by_asc("week")->find_many();
  foreach($lt_weeks as $lt_week){
    echo "              <option value=\"".escapeHTML($lt_week->id)."\">第".escapeHTML($lt_week->week)."回目(".escapeHTML($lt_week->date).")</option>";
  }
?>
          </select></label>
          <label><span>Screen name:</span><input type="text" name="screen" placeholder="Ex.) ナカジマ" value="<?php echo $current_user?($current_user->screen_name):"";?>"maxlength="100" /></label>
          <label><span>Title:</span><input type="text" name="title" placeholder="Ex.) キャベツとレタス、どっちがセキュア？" maxlength="100" required /></label>
          <label><span>Slides:</span><input type="file" name="slide" accept="application/pdf" required /></label>
          <label class="check">スライドを非公開に設定する<input type="checkbox" name="publish_slide" /></label>
          <label><span>KG:</span><select name="kg" required>
<?php
  $kgs = KG::find_many();
  foreach($kgs as $kg){
    echo "              <option value=\"".escapeHTML($kg->id)."\"".($current_user?($kg->id == $current_user->kg_id?" selected":""):"").">".escapeHTML($kg->name)."</option>";
  }
?>
          </select></label>
          <label><span>Year:</span><select name="year" required><!-- TODO: 一度登録すると以降は勝手にKGと学年選んでくれるように -->
<?php
  $years = Year::order_by_asc("id")->find_many();
  foreach($years as $year){
    echo "              <option value=\"".escapeHTML($year->id)."\"".($current_user?($year->id == $current_user->year_id?" selected":""):"").">".escapeHTML($year->name)."</option>";
  }
?>
          </select></label>
          <input type="submit" value="Submit" />
        </form>
<?php
  }
} else {
?>
        <h2>Error</h2>
        <p>
          Please login to register.
        </p>
<?php
        }
?>
      </div>
    </div>
  </body>
</html>