<?php
namespace App\Core\Handlers;
use Idearia\Logger;

abstract class Handler
{    
    /**
     * Корневая директория проекта
     *
     * @var string
     */
    public $root_dir = __DIR__;

    protected function handle() {
        return __CLASS__;
    }
    
    /**
     * Определяет корневую директорию проекта
     *
     * @return void
     */
    private function getRootDir()
    {
        $this->root_dir = explode("app", __DIR__)[0];
    }
    
    /**
     * Проверяет существует ли файл логов
     * Если нету - создает
     *
     * @return void
     */
    private function checkLogFile()
    {
        if (!is_dir($this->root_dir . LOG_DIR)) {
            mkdir($this->root_dir . LOG_DIR);
            touch($this->root_dir . LOG_DIR . "/parser-log.log");
            $gitignore = fopen($this->root_dir . LOG_DIR . "/.gitignore", 'w');
            fwrite( $gitignore, "*.log\n");
            fclose($gitignore);
        }
    }

    public function __construct() {
        $this->getRootDir();
        $this->setLogConf();

        
    }
    
    /**
     * Конфигурирует логер
     *
     * @return void
     */
    private function setLogConf()
    {
        $this->checkLogFile();

        Logger::$log_level = 'debug';
        Logger::$write_log = true;
        Logger::$print_log = false;
        Logger::$log_dir = LOG_DIR;
        Logger::$log_file_name = 'parser-log';
        Logger::$log_file_extension = 'log';
    }
}