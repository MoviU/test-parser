<h1>Parser</h1>

<p>Установка: </p>

```bash
    git clone https://github.com/MoviU/test-parser.git
    cd test-parser/
    composer install
```

<h4>Также требуется создать базу данных с гового образца <b>test_parser.sql</b></h4>

<p>Запуск(только через консоль)</p>

```bash
    cd /path/to/repository/
    php index.php "<url-к-сайту-для-парсинга>"
```
<h2>Конфигурация</h2>

<p>Файл конфигурации находиться по пути: </p>
    
`config/config.php`

<h2>Логи</h2>

<p>Логи записываются в файл по пути: </p>
    
`logs/parser-log.txt`
