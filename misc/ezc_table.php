<?php
require 'tests/bootstrap.php';
require 'ezc/Base/ezc_bootstrap.php';
spl_autoload_register( array( 'ezcBase', 'autoload' ) );


// Initialize the console output handler
$out = new ezcConsoleOutput();
// Define a new format "headline"
$out->formats->headline->color = 'red';
$out->formats->headline->style = array( 'bold' );
// Define a new format "sum"
$out->formats->sum->color = 'blue';
$out->formats->sum->style = array( 'negative' );

// Create a new table
$table = new ezcConsoleTable( $out, 78 );

// Create first row and in it the first cell
$table[0][0]->content = 'Headline 1';

// Create 3 more cells in row 0
for ( $i = 2; $i < 8; $i++ )
{
     $table[0][]->content = "json_serialize Headline $i";
}

$data = array( 1, 2, 3, 4 );

// Create some more data in the table...
foreach ( $data as $value )
{
     // Create a new row each time and set it's contents to the actual value
     $table[][0]->content = (string) $value;
}

// Set another border format for our headline row
$table[0]->borderFormat = 'none';

// Set the content format for all cells of the 3rd row to "sum"
$table[2]->format = 'sum';

$table->outputTable();
