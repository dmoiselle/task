<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class HTML_tasks
{
  function editTask( $row, $option )
  {
    $editor =& JFactory::getEditor();
    JHTML::_('behavior.calendar');
    ?>
    <form action="index.php" method="post"
                 name="adminForm" id="adminForm">
      <fieldset class="adminform">
        <legend>Task List</legend>
        <table class="admintable">
        <tr>
          <td width="100" align="right" class="key">
            Title:
          </td>
          <td>
            <input class="text_area" type="text" name="title"
               id="title" size="50" maxlength="250"
               value="<?php echo $row->title;?>" />
          </td>
        </tr>
        
          <td width="100" align="right" class="key">
            Description:
          </td>
          <td>
            <?php
            echo $editor->display( 'description',  $row->description ,
                                      '100%', '150', '40', '5' ) ;
            ?>
          </td>
        </tr>
        
        <tr>
          <td width="100" align="right" class="key">
            Date Due:
          </td>
          <td>
            <input class="inputbox" type="text" name="datedue"
               id="datedue" size="25" maxlength="19"
               value="<?php echo $row->datedue; ?>" />
            <input type="reset" class="button" value="..."
               onclick="return showCalendar('datedue',
               '%Y-%m-%d');" />
          </td>
        </tr>
       
        </table>
      </fieldset>
      <input type="hidden" name="id"
        value="<?php //echo $row->id; ?>" /> 
      <input type="hidden" name="option"
        value="<?php echo $option;?>" /> 
      <input type="hidden" name="task"
        value="" />
    </form>
    <?php
  }


function showTasks( $option, &$rows )
{
  ?>
  <form action="index.php" method="post" name="adminForm">
  <table class="adminlist">
    <thead>
      <tr>
        <th width="20">
          <input type="checkbox" name="toggle"
               value="" onclick="checkAll(<?php echo
               count( $rows ); ?>);" />
        </th>
        <th class="title" style="text-align:left">Title</th>
        <th width="20%" style="text-align:left">Date Due</th>
        <th width="45%" style="text-align:left">Description</th>
        
      </tr>
    </thead>
    <?php
	jimport('joomla.filter.filteroutput');
    $k = 0;
    for ($i=0, $n=count( $rows ); $i < $n; $i++)
    {
      $row = &$rows[$i];
      $checked = JHTML::_('grid.id', $i, $row->id );
      $published = JHTML::_('grid.published', $row, $i );
	  $link = JFilterOutput::ampReplace( 'index.php?option=' .
                $option . '&task=edit&cid[]='. $row->id );
      ?>
      <tr class="<?php echo "row$k"; ?>">
        <td>
          <?php echo $checked; ?>
        </td>
        <td>
          <a href="<?php echo $link; ?>">
		  <?php echo $row->title; ?></a>
        </td>
        <td>
          <?php echo $row->datedue; ?>
        </td>
        <td>
          <?php echo $row->description; ?>
        </td>
        
      </tr>
      <?php
      $k = 1 - $k;
    }
    ?>
  </table>
  <input type="hidden" name="option"
                    value="<?php echo $option;?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  </form>
  <?php
}

}
?>