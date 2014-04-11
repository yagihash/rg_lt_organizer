      <header>
        <div id="nav">
          <h1>RG LT Organizer</h1>
          <p id="description">
            2014年度春学期のRGで行うLTのためのページです。
          </p>
          <nav>
            <ul>
              <li>
                <a href="./">Top</a>
              </li>
              <li>
                <a href="./register.php">Register</a>
              </li>
              <li>
                <a href="./archive.php">Archive</a>
              </li>
<?php
if($current_user !== false){
?>
              <li>
                <a href="./mypage.php">Mypage</a>
              </li>
<?php
}
?>

              <li>
                <a href="./timer/">Timer</a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
