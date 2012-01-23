<?php
namespace SimpleBench;

class Utils
{

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
        if( $rate > 1000000 ) {
            return (int)( $rate / 1000000 ) . 'M/s';
        }
        elseif( $rate > 1000 ) {
            return (int)( $rate / 1000 ) . 'K/s';
        }
        return (int)( $rate ) . '/s';
    }


}


