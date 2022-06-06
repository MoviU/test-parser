<?php 
namespace App\Core;

use App\Core\Handlers\ParserHandler;

class Parser extends ParserHandler
{
    /**
     * Парсит название продукта
     *
     * @param  string $page
     * @return string
     */
    public function getTitle($page)
    {
        preg_match('@<h1 class="page__title overflow".*?>(.*?)</h1>@su', $page, $title);
        
        return count($title) == 2 ? trim($title[1]) : null;
    }
    
    /**
     * Парсит цену продукта
     *
     * @param  string $page
     * @return array
     */
    public function getPrice($page)
    {
        preg_match('@<div class="product-box__main_price">(.*?)</div>@su', $page, $price);

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
     * Парсит детали продукта
     *
     * @param  string $page
     * @return array
     */
    public function getDetails($page)
    {
        $result = [];
     
        preg_match('@<div class="product-box__spec_table" data-min="4">.*?<div class="product-box__spec_item prop-item">(.*?)</div>.*?<a href="#anchor-2" id="show-all-properties"@su', $page, $details);
        preg_match_all('@<div class="product-box__spec_item prop-item">.*?<div>(.*?)</div>.*?</div>@su', $details[0], $keys);
        preg_match_all('@<div class="product-box__spec_item prop-item">.*?<div>.*?</div>.*?<div>(.*?)</div>@su', $details[0], $values);

        foreach ($keys[1] as $id => $key) {
            $result[$key] = $values[1][$id];
        }

        return $result;
    }

    /**
     * Парсинг по строкам
     * 
     * @return void
     */
    private function parse()
    {
        // Парсинг
        $this->product['title'] = $this->getTitle($this->page_body);
        $this->product['price'] = $this->getPrice($this->page_body);
        $this->product['details'] = $this->getDetails($this->page_body);

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