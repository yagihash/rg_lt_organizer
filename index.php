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
        <h2>Rule</h2>
        <ul id="rule">
          <li><span class="rule_item">5分間で、濃すぎず、薄すぎないように話す</span></li>
          <li><span class="rule_item">明るく、楽しく話して、できれば笑いを取る</span></li>
          <li><span class="rule_item">みんなに知ってもらいたいことを話す</span></li>
        </ul>
        <h2>Table for April [x]th</h2>
        <table id="presenters">
          <thead>
            <tr>
              <th> </th>
              <th>Presenter</th>
              <th>KG</th>
              <th>Year</th>
              <th>Title</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th> </th>
              <th>Presenter</th>
              <th>KG</th>
              <th>Year</th>
              <th>Title</th>
            </tr>
          </tfoot>
          <tbody><!-- スライドへのリンクはログインしないと有効にならないようにする -->
            <tr>
            	<td>1</td>
            	<td>yagihash</td>
            	<td>ISC</td>
            	<td>B3</td>
            	<td><a href="#">sample_title_1</a></td>
            </tr>
            <tr>
            	<td>2</td>
            	<td>kazu1130</td>
            	<td>ISC</td>
              <td>B3</td>
            	<td><a href="#">sample_title_2</a></td>
            </tr>
            <tr>
            	<td>3</td>
            	<td>yagihash</td>
            	<td>ISC</td>
              <td>B3</td>
            	<td><a href="#">sample_title_3</a></td>
            </tr>
            <tr>
            	<td>4</td>
            	<td>kazu1130</td>
            	<td>ISC</td>
              <td>B3</td>
            	<td><a href="#">sample_title_4</a></td>
            </tr>
            <tr>
            	<td>5</td>
            	<td>yagihash</td>
            	<td>ISC</td>
              <td>B3</td>
            	<td><a href="#">sample_title_5</a></td>
            </tr>
            <tr>
            	<td>6</td>
            	<td>kazu1130</td>
            	<td>ISC</td>
              <td>B3</td>
            	<td><a href="#">sample_title_6</a></td>
            </tr>
            <tr>
            	<td>7</td>
            	<td>yagihash</td>
            	<td>ISC</td>
              <td>B3</td>
            	<td><a href="#">sample_title_7</a></td>
            </tr>
            <tr>
            	<td>8</td>
            	<td>kazu1130</td>
            	<td>ISC</td>
              <td>B3</td>
            	<td><a href="#">sample_title_8</a></td>
            </tr>
            <tr>
            	<td>9</td>
            	<td>yagihash</td>
            	<td>ISC</td>
              <td>B3</td>
            	<td><a href="#">sample_title_9</a></td>
            </tr>
            <tr>
            	<td>A</td>
            	<td>kazu1130</td>
            	<td>ISC</td>
              <td>B3</td>
            	<td><a href="#">sample_title_A</a></td>
            </tr>
            <tr>
              <td>B</td>
              <td>yagihash</td>
              <td>ISC</td>
              <td>B3</td>
              <td><a href="#">sample_title_B</a></td>
            </tr>
            <tr>
              <td>C</td>
              <td>kazu1130</td>
              <td>ISC</td>
              <td>B3</td>
              <td><a href="#">sample_title_C</a></td>
            </tr>
            <tr>
              <td>D</td>
              <td>yagihash</td>
              <td>ISC</td>
              <td>B3</td>
              <td><a href="#">sample_title_D</a></td>
            </tr>
            <tr>
              <td>E</td>
              <td>kazu1130</td>
              <td>ISC</td>
              <td>B3</td>
              <td><a href="#">sample_title_E</a></td>
            </tr>
            <tr>
              <td>F</td>
              <td>yagihash</td>
              <td>ISC</td>
              <td>B3</td>
              <td><a href="#">sample_title_F</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
