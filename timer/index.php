<?php
$headers = array(
  "Expires" => "-1",
  "Content-Type" => "text/html; charset=UTF-8",
  "Content-Security-Policy" => "default-src 'self' 'unsafe-eval'; style-src 'self' 'unsafe-inline'",
  "X-Frame-Options" => "DENY",
  "X-Content-Type-Options" => "nosniff",
  "X-XSS-Protection" => "1; mode=block"
);
foreach ($headers as $key => $value)
  header("{$key}: {$value}");
?>
<!DOCTYPE html>

<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <title>RG LT Timer</title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/script.js"></script>
  </head>

  <body>
    <div id="wrap">
      <div class="time_rest">
        <span id="presenter"></span>さんが話しています
        <br />
        <span class="time_rest">05:00</span>
      </div>
      <div class="controll">
        <form class="controll">
          <label>名前を入力して送信
            <br />
            <input type="text" id="login_name" placeholder="name" maxlength="10" size="10" autofocus required />
          </label>
        </form>
      </div>
    </div>
  </body>
</html>
