<?php
namespace App\Services\Utility;

use Illuminate\Support\Facades\Log;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class MyLogger implements ILoggerService {

	private static $logger = null;
	
	static function getLogger()
	{
		if (self::$logger == null)
		{
			self::$logger = new Logger('WebNotes');
			$stream = new StreamHandler('./storage/logs/WebNotes.log', Logger::DEBUG);
			$stream->setFormatter(new LineFormatter("%datetime% : %level_name% : %message% %context%\n", "g:iA n/j/Y"));
			self::$logger->pushHandler($stream);
		}
		return self::$logger;
	}
	
	public static function debug($message, $data=array())
	{
		self::getLogger()->debug($message, $data);
	}
	
	public static function info($message, $data=array())
	{
		self::getLogger()->info($message, $data);
	}
	
	public static function warning($message, $data=array())
	{
		self::getLogger()->warning($message, $data);
	}
	
	public static function error($message, $data=array())
	{
		self::getLogger()->error($message, $data);
	}

    /*    public function debug($message, $data=array()){
        Log::debug($message . (count($data) != 0 ? ' with data of ' . print_r($data, true) : ""));
    }
    
    public function info($message, $data=array()){
        Log::info($message . (count($data) != 0 ? ' with data of ' . print_r($data, true) : ""));
    }
    
    public function warning($message, $data=array()){
        Log::warning($message . (count($data) != 0 ? ' with data of ' . print_r($data, true) : ""));
    }
    
    public function error($message, $data=array()){
        Log::error($message . (count($data) != 0 ? ' with data of ' . print_r($data, true) : ""));
    }
*/
}

