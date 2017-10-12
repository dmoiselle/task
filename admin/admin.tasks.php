<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( JApplicationHelper::getPath( 'admin_html' ) );
JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
switch($task)
{
 case 'edit':
 case 'add':
  editTask( $option );
  break;
 case 'apply':
 case 'save':
  saveTask( $option, $task );
  break;
 case 'remove':
  removeTasks( $option );
  break;
 default:
  showTasks( $option );
  break;

}
function editTask($option )
{
  $row =& JTable::getInstance('Task', 'Table');
  $cid = JRequest::getVar( 'cid', array(0), '', 'array' );
  $id = $cid[0];
  $row->load($id);
  HTML_tasks::editTask($row, $option);
}

function saveTask( $option, $task )
{
  global $mainframe;
  $row =& JTable::getInstance('Task', 'Table');
  if (!$row->bind(JRequest::get('post')))
  {
    echo "<script> alert('".$row->getError()."');

             window.history.go(-1); </script>\n";
    exit();
  }
  $row->description = JRequest::getVar( 'description', '', 'post',
  'string', JREQUEST_ALLOWRAW );
  $row->title = JRequest::getVar( 'title', '', 'post', 'string',
  JREQUEST_ALLOWRAW );
  if(!$row->datedue)
    $row->datedue = date( 'Y-mm-dd' );
  if (!$row->store())
  {
    echo "<script> alert('".$row->getError()."');
             window.history.go(-1); </script>\n";
    exit();
  }
  switch ($task)
{
  case 'apply':
    $msg = 'Changes to Task saved';
    $link = 'index.php?option=' . $option .
       '&task=edit&cid[]='. $row->id;
    break;
  case 'save':
  case 'remove':
   removeTasks( $option );
   break;
  default:
    $msg = 'Task Saved';
    $link = 'index.php?option=' . $option;
    break;
}
$mainframe->redirect($link, $msg);
}

function showTasks( $option )
{
  $db =& JFactory::getDBO();
  $query = "SELECT * FROM #__tasks";
  $db->setQuery( $query );
  $rows = $db->loadObjectList();
  if ($db->getErrorNum()) {
      echo $db->stderr();
      return false;
  }
  HTML_tasks::showTasks( $option, $rows );
}



function removeTasks( $option )
{
  global $mainframe;
  $cid = JRequest::getVar( 'cid', array(), '', 'array' );
  $db =& JFactory::getDBO();
  if(count($cid))
  {
    $cids = implode( ',', $cid );
    $query = "DELETE FROM #__tasks WHERE id IN ( $cids )";
    $db->setQuery( $query );
    if (!$db->query())
    {
      echo "<script> alert('".$db->getErrorMsg()."');
      window.history.go(-1); </script>\n";
    }
  }
  $mainframe->redirect( 'index.php?option=' . $option );
}

?>