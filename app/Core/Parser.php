<?php 
namespace App\Core;

use App\Core\Handlers\ParserHandler;
use App\Helpers\ParserValidator;
use Idearia\Logger;

class Parser extends ParserHandler
{
    use ParserValidator;

    /**
     * Парсит название продукта
     *
     * @return string
     */
    public function getTitle()
    {
        Logger::info("Парсим название продукта");
        preg_match('@<h1 class="page__title overflow".*?>(.*?)</h1>@su', $this->page_body, $title);
        
        return count($title) == 2 ? trim($title[1]) : null;
    }
    
    /**
     * Парсит цену продукта
     *
     * @return array
     */
    public function getPrice()
    {
        Logger::info("Парсим цену продукта");
        preg_match('@<div class="product-box__main_price">(.*?)</div>@su', $this->page_body, $price);

        $price = count($price) == 2 ? explode(" ", trim($price[1])) : null;

        $currency = $price[count($price) - 1];
        array_pop($price);
        $amount = implode('', $price);

        return [
            "currency" => $currency,
            "amount" => $amount,
        ];
    }
        
    /**
     * Чистит занчения от ненужных пробелов
     *
     * @param  array $values
     * @return array
     */
    private function trimEverything(array $values)
    {
        foreach ($values as $key => $value) {
            foreach ($value[1] as $id => $field) {
                $values[$key][1][$id] = trim($field);
            }
        }

        return $values;
    }
    
    /**
     * Парсит большую таблицу характеристик
     *
     * @return array
     */
    private function parseDetailsLong()
    {
        Logger::info("Парсим большую таблицу характеристик");
        $details_parsed = [];
        $result = [];

        preg_match('@<div id="section-properties" class="main-details__body js-toggle-body" style="visibility:visible!important;">(.*?)<div id="properties-rules" class="main-details__rules">@su', $this->page_body, $details);
        preg_match_all('@<div class="main-details__item_name">.*?<span>(.*?)</span>.*?</div>@su', $details[0], $keys);
        preg_match_all('@<div class="main-details__item_value">.*?<span>(.*?)</span>.*?</div>@su', $details[0], $values);
        foreach ($values[1] as $key => $value) {
            preg_match_all('@>(.*?)</a>@su', $value, $details_parsed[]);
        }

        $details_parsed = $this->trimEverything($details_parsed);
        foreach ($keys[1] as $id => $key) {
            $result[trim($key)] = $details_parsed[$id][1];
        }

        return $result;
    }
    
    /**
     * Парсит маленькую таблицу характеристик
     *
     * @return array
     */
    public function parseDetailsShort()
    {
        Logger::info("Парсим маленькую таблицу характеристик");
        $result = [];

        preg_match('@<div class="product-box__spec_table" data-min="4">.*<div class="product-box__spec_item prop-item">(.*?)</div>.*<a href="#anchor-2" id="show-all-properties"@su', $this->page_body, $details);
        preg_match_all('@<div class="product-box__spec_item prop-item">.*<div>(.*?)</div>.*</div>@su', $details[0], $keys);
        preg_match_all('@<div class="product-box__spec_item prop-item">.*<div>.*</div>.*<div>(.*?)</div>@su', $details[0], $values);

        foreach ($keys[1] as $id => $key) {
            $result[trim($key)] = $details[$id][1];
        }

        return $result;
    }

    /**
     * Парсит детали продукта
     *
     * @return array
     */
    public function getDetails()
    {
        Logger::info("Парсим характеристики продукта");

        $details_long = $this->parseDetailsLong();
        $details_short = $this->parseDetailsShort();
        
        return [
            'details_long' => $details_long,
            'details_short' => $details_short,
        ];
    }

    /**
     * Парсинг по строкам
     * 
     * @return void
     */
    private function parse()
    {
        // Парсинг
        $this->product['title'] = $this->checkTitle($this->getTitle());
        $this->product['price'] = $this->checkPrice($this->getPrice());
        $this->product['details'] = $this->checkDetails($this->getDetails());

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
        $this->client = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
        $this->getBody(PARSE_URL);

        $this->parse();
    }
}