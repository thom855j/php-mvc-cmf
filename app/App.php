<?php

/*
 * App class conaining specific app settings
 * @author Thomas Elvin
 */

class App
{

    // object instance 
    protected static
            $_instance = null;
    public
            $env,
            $date_format;
    private
            $logs,
            $data;

    public
            function __construct()
    {
        
    }

    // singleton instance
    public static
            function load()
    {
        if (!isset(self::$_instance))
        {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public
            function set($case, $input)
    {
        switch ($case)
        {
            case 'env':
                // set env 
                if ($input == true)
                {
                    error_reporting(E_ALL);
                    ini_set('display_errors', true);
                    ini_set('display_startup_errors', true);
                    //ini_set('log_errors', 'On'); // enable or disable php error logging (use 'On' or 'Off') 
                    //ini_set('error_log', PATH_LOGS . 'php-error.log'); // path to server-writable log file 
                    $this->env = 'debug';
                }
                else
                {
                    error_reporting(0);
                    ini_set('display_errors', false);
                    ini_set('display_startup_errors', false);
                    ini_set('log_errors', false);
                    $this->env = 'live';
                }

                break;
                
            case 'date_format':
                $this->date_format = $input;
                break;

            default:
                break;
        }
    }

    public
            function register($case, $input)
    {

        static $data       = array();
        array_push($data, $input);
        $this->data[$case] = $data;
    }

    public
            function get($case)
    {

        $menus = $this->data[$case];
        foreach ($menus as $data)
        {
            foreach ($data as $value)
            {
                echo $value;
            }
        }
    }

}
