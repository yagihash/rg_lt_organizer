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
<?php
require_once(__DIR__ . "/page_header.php");
?>
      <div id="main">
        <h2>Table for April [x]th</h2>
        <table id="presenters">
          <thead>
            <tr>
              <th>Order</th>
              <th>Presenter</th>
              <th>Title</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Order</th>
              <th>Presenter</th>
              <th>Title</th>
            </tr>
          </tfoot>
          <tbody>
            <tr>
            	<td>1</td>
            	<td>yagihash</td>
            	<td><a href="#">sample_title_1</a></td>
            </tr>
            <tr>
            	<td>2</td>
            	<td>kazu1130</td>
            	<td><a href="#">sample_title_2</a></td>
            </tr>
            <tr>
            	<td>3</td>
            	<td>yagihash</td>
            	<td><a href="#">sample_title_3</a></td>
            </tr>
            <tr>
            	<td>4</td>
            	<td>kazu1130</td>
            	<td><a href="#">sample_title_4</a></td>
            </tr>
            <tr>
            	<td>5</td>
            	<td>yagihash</td>
            	<td><a href="#">sample_title_5</a></td>
            </tr>
            <tr>
            	<td>6</td>
            	<td>kazu1130</td>
            	<td><a href="#">sample_title_6</a></td>
            </tr>
            <tr>
            	<td>7</td>
            	<td>yagihash</td>
            	<td><a href="#">sample_title_7</a></td>
            </tr>
            <tr>
            	<td>8</td>
            	<td>kazu1130</td>
            	<td><a href="#">sample_title_8</a></td>
            </tr>
            <tr>
            	<td>9</td>
            	<td>yagihash</td>
            	<td><a href="#">sample_title_9</a></td>
            </tr>
            <tr>
            	<td>10</td>
            	<td>kazu1130</td>
            	<td><a href="#">sample_title_10</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
