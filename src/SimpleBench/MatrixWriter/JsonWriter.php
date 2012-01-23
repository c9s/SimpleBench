<?php
namespace SimpleBench\MatrixWriter;

/**
 * $writer = new JsonWriter;
 * $writer->write( 'file.json' , $comparison );
 *
 */

class JsonWriter extends Writer
{

    public function __construct()
    {

    }


    public function write($file, $cMatrix)
    {
        $data = $this->matrixToArray($cMatrix);
        $json = json_encode( $data );
        file_put_contents( $file , $json );
    }

}

