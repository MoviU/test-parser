<?php
require __DIR__ . '/vendor/autoload.php';

use App\Core\Parser;
use Idearia\Logger;
if (!$argv[1]) {
    die("\nНе указна ссылка на сайт при запуске парсера!\nПример запуска: \n\t php index.php \"<url-к-сайту-для-парсинга>\"");
}

define("PARSE_URL", strval($argv[1]));
// Запускаем парсер
try {
    $parser = new Parser();

    $parser->handle();
} catch (\Exception $e) {
    Logger::error($e);
}