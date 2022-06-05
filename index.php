<?php
require __DIR__ . '/vendor/autoload.php';

use App\Core\Parser;
use Idearia\Logger;

// Запускаем парсер
try {
    $parser = new Parser();

    $parser->handle();
} catch (\Exception $e) {
    Logger::error($e);
}