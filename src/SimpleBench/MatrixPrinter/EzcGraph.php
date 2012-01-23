<?php
namespace SimpleBench\MatrixPrinter;

class EzcGraph
{

    /*
    public $matrix;
    public $ordering;
    public $tasks;
     */

    /**
     * comparison matrix object
     */
    public $cMatrix;

    public function __construct($cMatrix)
    {
        $this->cMatrix = $cMatrix;
        /*
        $this->tasks = $cMatrix->tasks;
        $this->matrix = $cMatrix->matrix;
        $this->ordering = $cMatrix->ordering;
        */
    }

    public function output()
    {
        require 'ezc/Base/ezc_bootstrap.php';
        spl_autoload_register( array( 'ezcBase', 'autoload' ) );

        // Create a new line chart
        $graph = new \ezcGraphBarChart();
        if( extension_loaded('cairo_wrapper') ) {
            $graph->driver = new \ezcGraphCairoDriver;
        }
        else {
            $graph->driver = new \ezcGraphGdDriver();
            $graph->options->font = '/Users/c9s/Library/Fonts/AppleLiGothicMedium.ttf';
        }

        $graph->palette = new \ezcGraphPaletteEzBlue();
        $graph->title = 'Benchmarks';
        $graph->legend = true;

        $rateList = $this->cMatrix->getRateList();

        $graph->data['sample dataset'] = new \ezcGraphArrayDataSet(
            $rateList['tasks']
        );

        $fn = 'bar_chart.png';
        echo "Rendering to $fn";
        $graph->render( 700, 500, $fn );
    }

}

