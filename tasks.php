<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
echo '<div class="componentheading">To Do List</div>';

jimport('joomla.application.helper');
require_once( JApplicationHelper::getPath( 'html' ) );
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.
                 'components'.DS.$option.DS.'tables');
switch($task)
{
  case 'view':
    viewTask($option);
    break;
  default:
    showPublishedTasks($option);
    break;
}
function showPublishedTasks($option)
{
  $db =& JFactory::getDBO();
  $query = "SELECT * FROM #__tasks ORDER BY datedue DESC";
  $db->setQuery( $query );
  $rows = $db->loadObjectList();
  if ($db->getErrorNum())
  {
    echo $db->stderr();
    return false;
  }
  HTML_tasks::showTasks($rows, $option);
}

function viewTask($option)
{
  $id = JRequest::getVar('id', 0);
  $row =& JTable::getInstance('Task', 'Table');
  $row->load($id);
  if($id==0)
  {
    JError::raiseError( 404, JText::_( 'Invalid
                                    ID provided' ) );
  }
  HTML_tasks::showTask($row, $option);
}

?>