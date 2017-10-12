<?php
class HTML_tasks
{
  function showTasks($rows, $option)
  {
    ?><table><?php
    foreach($rows as $row)
    {
      $link = JRoute::_('index.php?option=' .
                    $option . '&id=' . $row->id .  '&task=view');
      echo
  '<tr>
    <td>
      <a href="' . $link . '">' . $row->title . '</a>
    </td>
  </tr>';
    }
    ?></table><?php
  }
  
  function showTask($row, $option)
{

  ?>
  <p class="contentheading"><?php echo $row->title; ?></p>

  <p><!--<div class="createdate">--><strong>Date Due:</strong><?php echo JHTML::Date
                              ($row->datedue); ?><!--</div>--></p>
  
  <p><strong>Description:</strong> <?php echo
                                    $row->description; ?></p>
  
  <?php $link = JRoute::_('index.php?option=' .
                                              $option) ; ?>
  <a href="<?php echo $link; ?>">&lt; return to the
                                              Task List</a>
  <?php
}


}
?>