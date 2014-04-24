<?php
require_once (__DIR__ . "/common.php");
$isAdmin = false;
if($isAuthed){
  $isAdmin = $current_user->isAdmin();
}
if(!$isAdmin){
  header("Location: {$base_url}");
  exit();
}

$token = postParamValidate("token");
$mode = postParamValidate("mode");
$week_talks = null;
if(checkToken($token)){
  try {
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
    }else if($mode == "order_choice"){
      $week_id = postParamValidate("id");
      $lt_week = LtWeek::find_one($week_id);
      $week_talks = array();
      if($lt_week !== false){
        $week_talks = $lt_week->talks();
      }
    }else if($mode == "order_change"){
      $talk_id = postParamValidate("talk_id");
      $talk = Talk::find_one($talk_id);
      $talk->order = postParamValidate("order");
      $talk->save();
      
      $week_id = postParamValidate("week_id");
      $lt_week = LtWeek::find_one($week_id);
      $week_talks = array();
      if($lt_week !== false){
        $week_talks = $lt_week->talks();
      }
    }
  } catch(PDOException $e){
    //主にユニーク設定したものが衝突した場合に起こる
    //TODO: いい感じのメッセージを表示する
    $error_flag = true;
  }
}
?>
<!DOCTYPE html>

<html lang="ja">
  <head>
<?php
require_once (__DIR__ . "/head.php");
?>
    <link rel="stylesheet" href="css/admin.css" />
  </head>

  <body>
<?php
require_once(__DIR__ . "/top_bar.php");
?>
    <div id="wrap">
<?php
require_once(__DIR__ . "/page_header.php");
?>
      <div id="main" class="admin">
        <h2>Admin menu</h2>
<?php
if(!is_null($week_talks)){
?>
        <table id="presenters">
          <thead>
            <tr>
              <th> </th>
              <th>Presenter</th>
              <th>KG</th>
              <th>Year</th>
              <th>Title</th>
              <th>Order</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th> </th>
              <th>Presenter</th>
              <th>KG</th>
              <th>Year</th>
              <th>Title</th>
              <th>Order</th>
            </tr>
          </tfoot>
          <tbody>
<?php
  $i =0;
  foreach($week_talks as $talk){
  $talker = $talk->user();
?>
            <tr>
            	<td><?php echo escapeHTML(dechex($i)); ?></td>
            	<td><?php echo escapeHTML($talker->screen_name); ?></td>
            	<td><?php echo escapeHTML($talker->kg()->name); ?></td>
            	<td><?php echo escapeHTML($talker->year()->name); ?></td>
            	<td><?php echo escapeHTML($talk->title); ?></td>
            	<td>
                  <form action="admin.php" method="POST" class="admin">
                    <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
                    <input type="hidden" name="mode" value="order_change" />
                    <input type="hidden" name="talk_id" value="<?php echo escapeHTML($talk->id); ?>" />
                    <input type="hidden" name="week_id" value="<?php echo escapeHTML(postParamValidate("id")); ?>" />
              	    <input type="text" name="order" value="<?php echo escapeHTML($talk->order); ?>" maxlength="3" />
              	    <input type="submit" value="Change" />
              	  </form>
              	</td>
            </tr>
<?php
  $i++;
  }
} else {

?>
          </tbody>
        </table>
        <h3>KG</h3>
        <div class="admin_form_box">
          <form action="admin.php" method="POST" class="admin">
            <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
            <input type="hidden" name="mode" value="kg_add" />
            <input type="text" name="name" placeholder="New KG name" />
            <input type="submit" value="Add KG" />
          </form>
          <form action="admin.php" method="POST" class="admin">
            <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
            <input type="hidden" name="mode" value="kg_delete" />
            <select name="id" required>
              <option value="">-----</option>
<?php
$kgs = KG::find_many();
foreach($kgs as $kg){
  echo "              <option value=\"".escapeHTML($kg->id)."\">".escapeHTML($kg->name)."</option>";
}
?>

            </select>
            <input type="submit" value="Delete KG" />
          </form>
          <form action="admin.php" method="POST" class="admin">
            <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
            <input type="hidden" name="mode" value="kg_change" />
            <select name="id" required>
              <option value="">-----</option>
<?php
$kgs = KG::find_many();
foreach($kgs as $kg){
  echo "              <option value=\"".escapeHTML($kg->id)."\">".escapeHTML($kg->name)."</option>";
}
?>

            </select>
            <input type="text" name="name" placeholder="KG name" />
            <input type="submit" value="Change KG name" />
          </form>
        </div>
        <h3>LT Weeks</h3>
        <div class="admin_form_box">
          <form action="admin.php" method="POST" class="admin">
            <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
            <input type="hidden" name="mode" value="week_add" />
            <input type="text" name="week" pattern="^[0-9]{1,2}$" maxlength="2" placeholder="1-12" />
            <input type="text" name="date" pattern="^[0-9]{4}-\d{2}-\d{2}$" maxlength="10" placeholder="YYYY-MM-DD" /><!-- Picker -->
            <input type="submit" value="Add Week" />
          </form>
          <form action="admin.php" method="POST" class="admin">
            <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
            <input type="hidden" name="mode" value="week_delete" />
            <select name="id" required>
              <option value="">-----</option>
<?php
$lt_weeks = LtWeek::find_many();
foreach($lt_weeks as $lt_week){
  echo "              <option value=\"".escapeHTML($lt_week->id)."\">第".escapeHTML($lt_week->week)."回目(".escapeHTML($lt_week->date).")</option>";
}
?>

            </select>
            <input type="submit" value="Delete Week" />
          </form>
          <form action="admin.php" method="POST" class="admin">
            <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
            <input type="hidden" name="mode" value="week_change" />
            <select name="id" required>
              <option value="">-----</option>

<?php
$lt_weeks = LtWeek::find_many();
foreach($lt_weeks as $lt_week){
  echo "              <option value=\"".escapeHTML($lt_week->id)."\">第".escapeHTML($lt_week->week)."回目(".escapeHTML($lt_week->date).")</option>";
}
?>

            </select>
            <input type="text" name="week" pattern="^[0-9]{1,2}$" maxlength="2" placeholder="1-12" />
            <input type="text" name="date" pattern="^[0-9]{4}-\d{2}-\d{2}$" maxlength="10" placeholder="YYYY-MM-DD" /><!-- Picker -->
            <input type="submit" value="Change Week" />
          </form>
          <form action="admin.php" method="POST" class="admin">
            <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
            <input type="hidden" name="mode" value="order_choice" />
            <select name="id" required>
              <option value="">-----</option>
<?php
$lt_weeks = LtWeek::find_many();
foreach($lt_weeks as $lt_week){
  echo "              <option value=\"".escapeHTML($lt_week->id)."\">第".escapeHTML($lt_week->week)."回目(".escapeHTML($lt_week->date).")</option>";
}
?>

            </select>
            <input type="submit" value="Order Change" />
          </form>
        </div>
<?php
}
?>
      </div>
    </div>
  </body>
</html>