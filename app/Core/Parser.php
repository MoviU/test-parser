<?php 
namespace App\Core;

use App\Core\Handlers\ParserHandler;

class Parser extends ParserHandler
{

    /**
     * Парсинг по строкам
     * 
     * @return void
     */
    private function parse()
    {
        // Парсинг
        $this->product['title'] = self::getTitle($this->page_body);
        $this->product['price'] = self::getPrice($this->page_body);
        $this->product['details'] = self::getDetails($this->page_body);

        // Сохранение
        $this->db->save($this->product);
    }

    /**
     * Обработчик запроса
     * 
     * @return void
     */
    public function handle()
    {
        // Запуск
        $this->parse();
    }
}