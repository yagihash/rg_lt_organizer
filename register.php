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
?>
        <h2>Register</h2>
        <form id="register" method="POST">
          <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
          <label><span>Date:</span><select name="date" required>
            <option value="1">4/10</option>
            <option value="2">4/17</option>
            <option value="3">4/24</option>
            <option value="4">5/1</option>
            <option value="5">5/8</option>
          </select></label>
          <label><span>Title:</span><input type="text" name="title" placeholder="Ex.) キャベツとレタス、どっちがセキュア？" maxlength="100" required /></label>
          <label><span>Slides:</span><input type="file" name="slide" accept="application/pdf" required /></label>
          <label class="check">スライドをこのページで公開する<input type="checkbox" name="publish_slide" checked /></label>
          <label><span>KG:</span><select name="kg" required>
            <option value="">-----</option>
            <option value="isc">ISC</option>
            <option value="hoge">HOGE</option>
            <option value="fuga">FUGA</option>
            <option value="piyo">PIYO</option>
          </select></label>
          <label><span>Year:</span><select name="year" required><!-- TODO: 一度登録すると以降は勝手にKGと学年選んでくれるように -->
            <option value="">-----</option>
            <option value="b1">B1</option>
            <option value="b2">B2</option>
            <option value="b3">B3</option>
            <option value="b4">B4</option>
            <option value="m1">M1</option>
            <option value="m2">M2</option>
            <option value="faculty">Faculty</option>
            <option value="other">Other</option>
          </select></label>
          <input type="submit" value="Submit" />
        </form>
<?php
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