<?php
require( 'tests/bootstrap.php');

$bench = new SimpleBench;
$bench->n = 60000;
$bench->title  = 'String';


$bench->iterate( 'concat' , 'string concat' , function() {
    return 'select ' .
		'ca.id as id,' . 
		'ca.start_time as start_time,' . 
		'ca.end_time as end_time' .
	' from ' . 
		'equipment_courseappointment as ca,' .
		'equipment_patientappointment as pa' .
	' where ' . 
		'ca.course_id = :course' . ' and ' .
		'pa.id = ca.paid_id' . ' and ' .
		'pa.state != 4' . ' and ' .
		'ca.date = :date';
});

$bench->iterate( 'qq' , 'string without concat' , function() {
    return "select 
		ca.id as id,
		ca.start_time as start_time,
		ca.end_time as end_time
	from 
		equipment_courseappointment as ca,
		equipment_patientappointment as pa
	where 
		ca.course_id = :course  and 
		pa.id = ca.paid_id and 
		pa.state != 4' . ' and 
		ca.date = :date";
});

$bench->iterate( 'qq_intp' , 'string without concat' , function() {
    $int = 4;
    return "select 
		ca.id as id,
		ca.start_time as start_time,
		ca.end_time as end_time
	from 
		equipment_courseappointment as ca,
		equipment_patientappointment as pa
	where 
		ca.course_id = :course  and 
		pa.id = ca.paid_id and 
		pa.state != $int' . ' and 
		ca.date = :date";
});

$bench->iterate( 'non_concat' , 'string without concat' , function() {
    return 'select 
		ca.id as id,
		ca.start_time as start_time,
		ca.end_time as end_time
	from 
		equipment_courseappointment as ca,
		equipment_patientappointment as pa
	where 
		ca.course_id = :course  and 
		pa.id = ca.paid_id and 
		pa.state != 4' . ' and 
		ca.date = :date';
});

$result = $bench->compare();
echo $result->output('console');
