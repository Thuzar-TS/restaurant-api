<?php 

namespace App\Helpers;

use Log as Log;

class CustomLog 
{
    public static function error($message, ...$data) 
    {
        $log_info = [
            'message' => $message,
		];
		$e = new \Exception;		
        $context = static::prepareInfo($e, $data);
        $log_info = array_merge($log_info, $context);
        Log::channel('custom-logger')->error($log_info);
    }

    public static function info($message, ...$data) 
    {
        $log_info = array_merge([
            'message' => $message,
        ], static::prepareInfo(new \Exception, $data));
        Log::channel('custom-logger')->info($log_info);
    }

    private static function prepareInfo($exception, $data) 
    {
		$log_info = [];		
		$trace = $exception->getTrace()[0];
		$trace2 = $exception->getTrace()[1];
		$log_info['file'] = $trace['file'];
		$log_info['class'] = $trace2['class'];
        $log_info['function'] = $trace2['function'];
        $log_info['line'] = $trace['line'];
        if (!empty($data)) 
            $log_info = array_merge($log_info, $data);
        return $log_info;
    }
}