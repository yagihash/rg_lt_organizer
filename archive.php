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
//過去のデータを取ってくるRAW_SQL
$lt_weeks = LtWeek::getPasts();
?>
      <div id="main" class="content"><?php
foreach($lt_weeks as $lt_week){
?>
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
  $talks = $lt_week->talks();
  foreach($talks as $talk){
    $talker = $talk->user();
?>
            <tr>
            	<td><?php echo escapeHTML($talk->id); ?></td>
            	<td><?php echo escapeHTML($talker->screen_name); ?></td>
            	<td><?php echo escapeHTML($talker->kg()->name); ?></td>
            	<td><?php echo escapeHTML($talker->year()->name); ?></td>
            	<td><?php if($isAuthed){echo '<a href="slide.php?f=' . escapeHTML($talk->slide) . '" target="_blank">';} ?><?php echo escapeHTML($talk->title); ?><?php if($isAuthed){echo "</a>";} ?></td>
            </tr>
<?php
  }
?>
          </tbody>
        </table>
<?php
}
?>
      </div>
    </div>
  </body>
</html>