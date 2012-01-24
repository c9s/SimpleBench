<?php
require 'tests/bootstrap.php';
require 'ezc/Base/ezc_bootstrap.php';
spl_autoload_register( array( 'ezcBase', 'autoload' ) );


// Create a new line chart
$graph = new ezcGraphBarChart();

$graph->palette = new ezcGraphPaletteEzBlue();
$graph->title = 'Access statistics';
$graph->legend = false;


/** with cairo driver **/
/*
$graph->driver = new ezcGraphCairoDriver;
 */

/** with gd **/
/*
$graph->driver = new ezcGraphGdDriver();
$graph->options->font = '/Users/c9s/Library/Fonts/AppleLiGothicMedium.ttf';
 */


// Add data to line chart
$graph->data['sample dataset'] = new ezcGraphArrayDataSet(
    array(
        'a' => 1.2,
        'b' => 43.2,
        'c' => -34.14,
        'd' => 65,
        'f' => 123,
    )
);

// Render chart with default 2d renderer and default SVG driver
// $graph->render( 500, 200, 'bar_chart.svg' );
$graph->render( 500, 200, 'bar_chart.png' );
