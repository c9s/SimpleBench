<?php
namespace SimpleBench\SystemInfo;
use SimpleBench\Utils;

class Darwin
{
    static function getInfo()
    {
        $info = array();

        // get os information
        $info['php_os'] = PHP_OS;
        $info['php_uname'] = php_uname();
        $info['php_version'] = PHP_VERSION;

        // XXX: get cpu information


        /*
        for Darwin, 

            System Memory info:

                @see http://osxdaily.com/2007/05/16/quickly-check-mac-os-xs-virtual-memory-usage/

                $ vm_stat

            CPU info:

                $ sysctl -n machdep.cpu.brand_string
                $ system_profiler | grep Processor
        */
        $info['vm_stat'] = Utils::execute('vm_stat')->stdout;
        $info['cpu.brand_string'] = Utils::execute('sysctl -n machdep.cpu.brand_string')->stdout;

        $info['xdebug'] = extension_loaded('xdebug');

        // get memory information
        return $info;
    }
}



