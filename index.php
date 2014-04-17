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

//次回のLTの予定を取ってくるRAW_SQL
$lt_week = LtWeek::getNext();
$talks = array();
if($lt_week !== false){
  $talks = $lt_week->talks();
} else {
  //一番近い日付のデータを取ってくるRAW_SQL
  $lt_week = LtWeek::getRecent();
  if($lt_week !== false){
    $talks = $lt_week->talks();
  } else {
    //空だった場合のぬるぽ防止
    $lt_week = LtWeek::create();
    $lt_week->date = date("Y-m-d");
    $lt_week->week = 0;
    $lt_week->id = 0;
  }
}
?>
      <div id="main" class="content">
        <h2>Rule</h2>
        <ul id="rule">
          <li><span class="rule_item">5分間で、濃すぎず、薄すぎないように話す</span></li>
          <li><span class="rule_item">明るく、楽しく話して、できれば笑いを取る</span></li>
          <li><span class="rule_item">みんなに知ってもらいたいことを話す</span></li>
        </ul>
        
        <h2>Table on <?php echo escapeHTML($lt_week->date); ?> (第<?php echo escapeHTML($lt_week->week); ?>週目)</h2>
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
          <tbody>
<?php
$i=0;
foreach($talks as $talk){
  $talker = $talk->user();
?>
            <tr>
            	<td><?php echo escapeHTML(dechex($i)); ?></td>
            	<td><?php echo escapeHTML($talker->screen_name); ?></td>
            	<td><?php echo escapeHTML($talker->kg()->name); ?></td>
            	<td><?php echo escapeHTML($talker->year()->name); ?></td>
            	<td><?php echo escapeHTML($talk->title); ?></td>
            </tr>
<?php
  ++$i;
}
?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
