<?php
namespace App\Helpers;
use Idearia\Logger;

trait ParserValidator 
{    
    /**
     * Проверяет цену на правильность данных
     *
     * @param  array $price
     * @return array
     */
    public function checkPrice(array $price)
    {
        try {
            if (
                (intval($price['amount']) && strlen($price['amount']) > 0) 
                    &&
                (strlen($price['currency']) > 0)
                ) 
            {
                return $price;
            }

            throw new \Exception;
        } catch (\Exception $e) {
            Logger::error($price, "Ошибка парсинга цены. Данные парсера устарели. Массив с ценой: ");
            die("Ошибка парсинга цены");
        }
    }
    
    /**
     * Проверяет заголовок на правильность данных
     *
     * @param  string $title
     * @return string
     */
    public function checkTitle(string $title)
    {
        try {
            if (strlen($title) > 0) 
            {
                return $title;
            }

            throw new \Exception;
        } catch (\Exception $e) {
            Logger::error($title, "Ошибка парсинга заголовка. Данные парсера устарели. Заголовок: ");
            die("Ошибка парсинга заголовка");
        }
    }
    
    /**
     * Проверяет массив характеристик на правильность данных
     *
     * @param  array $details
     * @return array
     */
    public function checkDetails(array $details)
    {
        try {
            foreach ($details as $key => $value) {
                if (is_array($value)) {
                    $this->checkDetails($value);
                } else if (strlen($key) <= 0 || strlen($value) <= 0) {
                    throw new \Exception;
                }
            }
            return $details;
        } catch (\Exception $e) {
            Logger::error($details, "Ошибка парсинга характеристик. Данные парсера устарели. Массив характеристик: ");
            die("Ошибка парсинга характеристик");
        }
    }
}