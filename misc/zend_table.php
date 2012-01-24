<?php
require 'tests/bootstrap.php';

$table = new Zend_Text_Table(array('columnWidths' => array(10, 20)));
 
// Either simple
$table->appendRow(array('Zend', 'Framework 123123123123 123 jijfiejfijeifjeijfiejf'));
 
// Or verbose
$row = new Zend_Text_Table_Row();
 
$row->appendColumn(new Zend_Text_Table_Column('Zend'));
$row->appendColumn(new Zend_Text_Table_Column('Framework'));
 
$table->appendRow($row);
 
echo $table;

?>
