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
    </div>
  </body>
</html>