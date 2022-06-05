<?php
namespace App\Core\Handlers;

use App\Core\Handlers\DB;
use App\Core\Handlers\Handler;
use Idearia\Logger;
class ParserHandler extends Handler
{
    /**
     * Все данные про товар
     *
     * @var array
     */
    public $product = [];
 
    /**
     * База данных
     *
     * @var DB
     */
    public $db;
        
    /**
     * Клиент Guzzle
     *
     * @var GuzzleHttp\Client
     */
    private $client;
    
    /**
     * Ответ страницы
     *
     * @var mixed
     */
    private $response;

    /**
     * Тело страницы
     *
     * @var string
     */
    protected $page_body;

    public function __construct()
    {
        parent::__construct();
        $this->db = new DB();
        $this->client = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
        $this->getBody(PARSE_URL);
    }
        
    /**
     * Дeлает запрос
     *
     * @param  string $page
     * @return void
     */
    private function sendRequest($page) 
    {
        $this->response = $this->client->request("GET", $page);
        Logger::info("Запрос на страницу: " . $page);
        $this->checkResponse($page);
    }
    
    /**
     * Проверяет код ответа
     *
     * @return void
     */
    private function checkResponse($page)
    {
        if ($this->response->getStatusCode() !== 200) {
            Logger::error("Код: ". $this->response->getStatusCode() . " при запросе на страницу ". $page);
            if ($this->response->getStatusCode == 503) {

            }
            die('Request Error');
        }
        Logger::info("Код: ". $this->response->getStatusCode() . " при запросе на страницу ". $page);
        
    }

    /**
     * Получает тело страницы
     *
     * @param  string $page
     * @return void
     */
    private function getBody(string $page)
    {
        if (!$this->response) {
            $this->sendRequest($page);
        }
        // $this->page_body = file_get_contents($page);
        $this->page_body = $this->response->getBody();
    }
    
    /**
     * Парсит название продукта
     *
     * @param  string $page
     * @return string
     */
    public static function getTitle($page)
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
    public static function getPrice($page)
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
    public static function getDetails($page)
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
}