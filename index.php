<?php
require __DIR__ . '/vendor/autoload.php';

use App\Core\Parser;

// Запускаем парсер
$parser = new Parser();

$parser->handle();