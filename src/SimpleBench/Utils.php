<?php
namespace SimpleBench;

class Utils
{

    static function execute($cmd,$input = null)
    {
        $proc=proc_open($cmd, array(
            0 => array('pipe', 'r'), 
            1 => array('pipe', 'w'), 
            2 => array('pipe', 'w')), $pipes); 

        if( $input )
            fwrite($pipes[0], $input);

        fclose($pipes[0]); 
        $stdout = stream_get_contents($pipes[1]);fclose($pipes[1]); 
        $stderr = stream_get_contents($pipes[2]);fclose($pipes[2]); 
        $rtn = proc_close($proc); 
        return (object) array(
            'stdout' => $stdout,
            'stderr' => $stderr,
            'return' => $rtn
        ); 
    }

    static function pretty_size($bytes)
    {
        if( $bytes > 1000000 ) {
            return (int)( $bytes / 1000000 ) . 'M';
        }
        elseif( $bytes > 1000 ) {
            return (int)( $bytes / 1000 ) . 'K';
        }
        return (int) ($bytes) . 'B';
    }

    static function pretty_rate($rate)
    {
        if( $rate > 1000 * 1000 ) {
            return round( $rate / 1000 / 1000,2) . 'M/s';
        } elseif( $rate > 1000 ) {
            return round( $rate / 1000,2) . 'K/s';
        } else {
            return round( $rate ,2 ) . '/s';
        }
    }


}


