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
      <table>
          <thead>
            <tr>
              <th> </th>
              <th>Title</th>
              <th>Slide</th>
              <th>Edit/Delete</th>
            </tr>
          </thead>
<?php
if($isAuthed){
      $talks = $current_user->talks();
      foreach($talks as $talk){
?>
            <tr>
            	<td><?php echo escapeHTML($talk->id); ?></td>
            	<td><?php echo escapeHTML($talk->title); ?></td>
            	<td><?php echo '<a href="slide.php?f=' . escapeHTML($talk->slide) . '" target="_blank">'; ?><?php echo escapeHTML($talk->title); ?><?php echo "</a>"; ?></td>
                <td><a href="edit.php?id=<?php echo escapeHTML($talk->id); ?>">Edit</a><a href="delete.php?id=<?php echo escapeHTML($talk->id); ?>">Delete</a></td>
            </tr>

<?php
}
?>
</table>


<?php
} else{
?>




<?php
}    
?>
      </div>
    </div>
  </body>
</html>