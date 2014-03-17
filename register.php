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
if($isAuthed) {
?>
        <h2>Register</h2>
        <form method="POST">
          <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
          <label>Title: <input type="text" name="title" /></label>
          <label>Slide: <input type="file" name="slide" accept="application/pdf" /></label>
          <label>スライドをこのページで公開する<input type="checkbox" name="publish_slide" /></label>
          <label>KG: <select name="kg">
            <option>-----</option>
          	<option value="isc">ISC</option>
          	<option value="hoge">HOGE</option>
          	<option value="fuga">FUGA</option>
          	<option value="piyo">PIYO</option>
          </select></label>
          <label>Year: <select name="year"><!-- TODO: 一度登録すると以降は勝手に学年選んでくれるように -->
          	<option value="b1">B1</option>
          	<option value="b2">B2</option>
          	<option value="b3">B3</option>
          	<option value="b4">B4</option>
          	<option value="m1">M1</option>
          	<option value="m2">M2</option>
          	<option value="faculty">Faculty</option>
          	<option value="Other">Other</option>
          </select></label>
        </form>
<?php
} else {
?>
        <h2>Error</h2>
        <p>Please login to register.</p>
<?php
}
?>
      </div>
    </div>
  </body>
</html>