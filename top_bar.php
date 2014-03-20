      <nav id="top_bar">
        <ul>
          <li>
            <a href="./">Top</a>
          </li>
          <li>
            <a href="./register.php">Register</a>
          </li>
          <li>
            <a href="./schedule.php">Schedule</a>
          </li>
          <li>
            <a href="./archive.php">Archive</a>
          </li>
          <li>
            <a href="./timer/">Timer</a>
          </li>
        </ul>
<?php
  if($isAuthed) {
?>
        <div id="login">
          <span>Hello,</span><span id="name"><?php echo escapeHTML($_SESSION["name"]); ?></span>
          <a href="<?php echo "{$base_url}/logout.php"; ?>">Logout</a>
        </div>
<?php
  } else {
    $_SESSION["view_page"] = $_SERVER["REQUEST_URI"];
?>
        <div id="login">
          <form action="login.php" method="POST">
            <input type="hidden" name="token" value="<?php echo issueToken(); ?>" />
            <input type="text" name="login_name" placeholder="Login name" pattern="^[a-zA-Z0-9]{1,10}$" maxlength="10" autofocus />
            <input type="password" name="password" placeholder="Password" />
            <input type="submit" value="Login" />
          </form>
        </div>
<?php
  }
?>
      </nav>
