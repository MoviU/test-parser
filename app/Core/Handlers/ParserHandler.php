<?php
namespace App\Core\Handlers;

use App\Core\Handlers\DB;
use App\Core\Handlers\Handler;
use App\Core\Mail;
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
    protected $client;
    
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
    }
        
    /**
     * Дeлает запрос
     *
     * @param  string $page
     * @return void
     */
    private function sendRequest($page) 
    {
        if (!$page) {
            Logger::error("Страница в файле конфигураций не указана");
            die("Страница в файле конфигураций не указана");
        }
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
            if ($this->response->getStatusCode() == 503) {
                Mail::$message = "Ошибка 503 при запросе на страницу " . $page;
                Mail::sendAlertMail();
            }
            die("ОШИБКА!  Код: ". $this->response->getStatusCode() . " при запросе на страницу ". $page);
        }
        Logger::info("Код: ". $this->response->getStatusCode() . " при запросе на страницу ". $page);
        
    }
    
    /**
     * Получает тело страницы
     *
     * @param  string $page
     * @return void
     */
    protected function getBody(string $page)
    {
        Logger::info("Получаем тело страницы");
        echo "Получаем тело страницы\n";

        if (!$this->response) {
            $this->sendRequest($page);
        }

        $this->page_body = $this->response->getBody();
    }
}