      <nav id="top_bar">
        <ul>
          <li>
            <a href="./">Top</a>
          </li>
          <li>
            <a href="./register.php">Registration</a>
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
          <span>Hello,</span><span id="name"><?php echo $_SESSION["name"]; ?></span>
          <a href="<?php echo "{$base_url}/logout.php"; ?>">Logout</a>
        </div>
<?php
  } else {
?>
        <div id="login">
          <form action="login.php" method="POST">
            <input type="text" name="login_name" placeholder="Login name" pattern="[a-zA-Z0-9]{1,10}" maxlength="10" autofocus />
            <input type="password" name="password" placeholder="Password" pattern="[a-zA-Z0-9]+" />
            <input type="submit" value="Login" />
          </form>
        </div>
<?php
  }
?>
      </nav>
