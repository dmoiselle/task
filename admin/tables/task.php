<?php
defined('_JEXEC') or die('Restricted access');
class TableTask extends JTable
{
  var $id = null;
  var $title = null;
  var $datedue = null;
  var $description = null;
  
  function __construct(&$db)
  {
    parent::__construct( '#__tasks', 'id', $db );
  }
}
?>