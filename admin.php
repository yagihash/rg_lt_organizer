<?php
require_once (__DIR__ . "/common.php");
$isAdmin = false;
if($isAuthed){
  $user = User::find_one($_SESSION["current_id"]);
  //TODO: どうにかする
  if($user->login_name == "kazu1130" || 
     $user->login_name == "yagihash" ){
    $isAdmin = true;
  }
}
if(!$isAdmin){
  header("Location: {$base_url}");
  exit();
}

$token = postParamValidate("token");
$mode = postParamValidate("mode");

if(checkToken($token)){
  if($mode == "kg_add"){
    $name = postParamValidate("name");
    if($name != ""){
      $new_kg = KG::create();
      $new_kg->name = $name;
      $new_kg->save();
    }
  }else if($mode == "kg_delete"){
    $kg_id = postParamValidate("id");
    $kg = KG::find_one($kg_id);
    if($kg !== false){
      $kg->delete();
    }
  }else if($mode == "kg_change"){
    $name = postParamValidate("name");
    $kg_id = postParamValidate("id");
    $kg = KG::find_one($kg_id);
    if($kg !== false){
      $kg->name = $name;
      $kg->save();
    }
  }else if($mode == "week_add"){
    $week = postParamValidate("week");
    $date = postParamValidate("date");
    $lt_week = LtWeek::create();
    $lt_week->week = $week;
    $lt_week->date = $date;
    $lt_week->save();
  }else if($mode == "week_delete"){
    $week_id = postParamValidate("id");
    $lt_week = LtWeek::find_one($week_id);
    if($lt_week !== false){
      $lt_week->delete();
    }
  }else if($mode == "week_change"){
    $week_id = postParamValidate("id");
    $lt_week = LtWeek::find_one($week_id);
    if($lt_week !== false){
      $date = postParamValidate("date")?postParamValidate("date"):$lt_week->date;
      $week = postParamValidate("week")?postParamValidate("week"):$lt_week->week;
      $lt_week->date = $date;
      $lt_week->week = $week;
      $lt_week->save();
    }
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
    </div>
    <div id="main">
          <form action="admin.php" method="POST">
            <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
            <input type="hidden" name="mode" value="kg_add" />
            <input type="text" name="name" placeholder="KG name" />
            <input type="submit" value="Add KG" />
          </form>
          <form action="admin.php" method="POST">
            <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
            <input type="hidden" name="mode" value="kg_delete" />
            <select name="id" required>
              <option value="">-----</option>
<?php
$kgs = KG::find_many();
foreach($kgs as $kg){
  echo "              <option value=\"{$kg->id}\">{$kg->name}</option>";
}
?>
            </select>
            <input type="submit" value="Delete KG" />
          </form>
          <form action="admin.php" method="POST">
            <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
            <input type="hidden" name="mode" value="kg_change" />
            <select name="id" required>
              <option value="">-----</option>
<?php
$kgs = KG::find_many();
foreach($kgs as $kg){
  echo "              <option value=\"{$kg->id}\">{$kg->name}</option>";
}
?>
            </select>
            <input type="text" name="name" placeholder="KG name" />
            <input type="submit" value="Change KG name" />
          </form>
          <form action="admin.php" method="POST">
            <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
            <input type="hidden" name="mode" value="week_add" />
            <input type="text" name="week" pattern="^[0-9]{1,2}$" maxlength="2" placeholder="Week" />
            <input type="text" name="date" pattern="^[0-9]{4}-\d{2}-\d{2}$" maxlength="10" placeholder="Date" /><!-- Picker -->
            <input type="submit" value="Add Week" />
          </form>
          <form action="admin.php" method="POST">
            <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
            <input type="hidden" name="mode" value="week_delete" />
            <select name="id" required>
              <option value="">-----</option>

<?php
$lt_weeks = LtWeek::find_many();
foreach($lt_weeks as $lt_week){
  echo "              <option value=\"{$lt_week->id}\">第{$lt_week->week}回目({$lt_week->date})</option>";
}
?>
            </select>
            <input type="submit" value="Delete Week" />
          </form>
          <form action="admin.php" method="POST">
            <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
            <input type="hidden" name="mode" value="week_change" />
            <select name="id" required>
              <option value="">-----</option>

<?php
$lt_weeks = LtWeek::find_many();
foreach($lt_weeks as $lt_week){
  echo "              <option value=\"{$lt_week->id}\">第{$lt_week->week}回目({$lt_week->date})</option>";
}
?>
            </select>
            <input type="text" name="week" pattern="^[0-9]{1,2}$" maxlength="2" placeholder="Week" />
            <input type="text" name="date" pattern="^[0-9]{4}-\d{2}-\d{2}$" maxlength="10" placeholder="Date" /><!-- Picker -->
            <input type="submit" value="Change Week" />
          </form>
    </div>
  </body>
</html>