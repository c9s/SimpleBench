<?php
require( 'tests/bootstrap.php');

$bench = new SimpleBench;
$bench->n = 100000;
$bench->title  = 'String';


$bench->iterate( 'q_with_concat' , 'string concat' , function() {
    $int = 4;
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
		'pa.state != ' . $int . ' and ' .
		'ca.date = :date';
});

$bench->iterate( 'qq_with_concat' , 'double quotes string without concat' , function() {
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
		pa.state != " . $int . " and 
		ca.date = :date";
});

$bench->iterate( 'qq_interpolation' , 'string without concat' , function() {
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
		pa.state != $int and 
		ca.date = :date";
});

$bench->iterate( 'q' , 'string without concat' , function() {
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
		pa.state != $int and 
		ca.date = :date';
});

$result = $bench->compare();
echo $result->output('console');
