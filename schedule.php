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
    <div id="wrap">
      <header>
        <h1 id="title">RG LT Organizer</h1>
        <p id="description">
          2014年度春学期のRGの授業のためのページです。
          <br />
          LT(Lightning Talk)に関する進行など全般を取り扱うのはこちら。
          <br />
          発表者エントリーや資料登録はこちらで行ってください。
        </p>
        <nav>
          <ul>
            <li>
              <a href="./">Top</a>
            </li>
            <li>
              <a href="">Registration</a>
            </li>
            <li>
              <a href="">Schedule</a>
            </li>
          </ul>
        </nav>
        <div id="login_form">
          <form action="login.php" method="POST">
            <input type="text" length="10" name="login_name" placeholder="Login name" pattern="[a-zA-Z0-9]{1,10}" maxlength="10" autofocus />
            <input type="password" length="15" name="password" placeholder="Password" pattern="[a-zA-Z0-9]+" />
            <input type="submit" value="Log in" />
          </form>
        </div>
      </header>