<?php
namespace App\Core\Handlers;
use Idearia\Logger;

abstract class Handler
{
    protected function handle() {
        return __CLASS__;
    }

    public function __construct() {
        Logger::$log_level = 'debug';
        Logger::$write_log = true;
        Logger::$log_dir = 'logs';
        Logger::$log_file_name = 'parser-log';
        Logger::$log_file_extension = 'txt';
    }
}