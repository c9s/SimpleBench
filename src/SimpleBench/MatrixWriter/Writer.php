<?php

namespace SimpleBench\MatrixWriter;

class Writer
{

    public function matrixToArray($cMatrix)
    {
        $data = array();
        $data['matrix'] = $cMatrix->matrix;
        $data['ordering'] = $cMatrix->ordering;
        $data['tasks'] = array();
        foreach( $cMatrix->tasks as $task ) {
            $data['tasks'][ $task->name ] = $task->getData();
        }
        return $data;
    }

}


