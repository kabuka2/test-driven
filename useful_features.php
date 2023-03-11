<?php
require_once '../vendor/autoload.php';

function debug($data = '')
{
    $trace = debug_backtrace();
    $trace = array_shift($trace);
    printf(
        '<b>Call file: %s  line: %s <br> type: %s <br> ' ,
        $trace['file'],
        $trace['line'],
        gettype($data),
    );

    if (is_bool($data)) {
        var_dump($data);
    } else if (is_string($data) || is_numeric($data)) {
        printf('string length: %s symbols <br>  string: %s <br><br><br>',strlen($data),$data);
    } else {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}

function dd($data = '')
{
    $trace = debug_backtrace();
    $trace = array_shift($trace);
    printf(
        '<b>Call file: %s  line: %s <br> type: %s <br> ' ,
        $trace['file'],
        $trace['line'],
        gettype($data),
    );

    if (is_bool($data)) {
        var_dump($data);
    } else if (is_string($data) || is_numeric($data)) {
        printf('string length: %s symbols <br>  string: %s',strlen($data),$data);
    } else {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    exit();
}

if (!function_exists('throw_if')) {
/**
 * @param bool $param
 * @param $exception || obj class || string name Exception class "use name space app\Exception and need create class"
 */
function throw_if(bool $param, string $message = "",$code = 0,$exception = '')
{
    if ($param) {
        if (is_string($exception)) {
            if (empty($exception)) {
                $exception = 'DefaultException';
            }
            $exception_name = sprintf('app\exception\%s',$exception);
            $exception = new $exception_name($message,$code);
        }
        throw $exception;
    }

}
}
?>