<?php
require __DIR__ . '/vendor/autoload.php';

use App\Core\Parser;
use Idearia\Logger;
define("PARSE_URL", strval($argv[1]));
// Запускаем парсер
try {
    $parser = new Parser();

    $parser->handle();
} catch (\Exception $e) {
    Logger::error($e);
}