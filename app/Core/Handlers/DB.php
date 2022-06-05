<?php
namespace App\Core\Handlers;

use App\Core\Handlers\Handler;
use Idearia\Logger;
use mysqli;

class DB extends Handler
{    
    /**
     * База данных
     *
     * @var mysqli
     */
    public $db;
    
    /**
     * Подулючение к базе данных
     *
     * @param  string $host
     * @param  string $user
     * @param  string $pass
     * @param  string $name
     * @return void
     */
    public function __construct($host = DB_HOST, $user = DB_USER, $pass = DB_PASS, $name = DB_NAME)
    {
        if ($host == null || $user == null || $pass == null || $name == null) {
            Logger::error("Файл конфигурации базы данных пуст");
            die("Файл конфигурации базы данных пуст");
        }
        $this->db = new mysqli($host, $user, $pass, $name);
        if ($this->db->connect_errno) {
            Logger::error("Ошибка подключения к базе данных: " . $this->db->connect_error . "\n");
           
            exit();
        }
        Logger::info("Успешное подключение к базе данных");
    }
    
    /**
     * Отключение от базы
     *
     * @return void
     */
    public function __destruct()
    {
        if ($this->db) {
            $this->db->close();
            Logger::info("Отключение от базы данных");
        }
    }
        
    /**
     * Сохранение в базу
     *
     * @param  array $product
     * @return void
     */
    public function save($product)
    {
        Logger::debug($product, "Данные о товаре: ");
        $saved_product = $this->db->query("SELECT * FROM `products` WHERE `title` = '". $product['title'] ."';")->fetch_assoc();

        if ($saved_product) {
            Logger::info("Обновление товара №" . $saved_product['id']);
            $this->update($saved_product, $product);
        } else {
            Logger::info("Создание новго товара");
            $this->create($product);
        }
    }
        
    /**
     * Создает продукт
     *
     * @param  array $product_data
     * @return void
     */
    public function create($product_data)
    {
        $price_id = $this->savePrice($product_data['price']);
        $detail_id = $this->saveDetails($product_data['details']);
        
        $this->db->query("INSERT INTO `products` (`title`, `detail_id`, `price_id`) VALUES ('" . $product_data['title'] . "', " . $price_id . ", " . $detail_id . ");");
        Logger::debug("Продукт №" . $this->db->insert_id . " был успешно добавлен");
    }

    /**
     * Обновляет продукт
     *
     * @param  array $old_product
     * @param  array $new_product_data
     * @return void
     */
    public function update(array $old_product, array $new_product_data)
    {
        $this->updatePrice($new_product_data['price'], $old_product['price_id']);
        $this->updateDetails($new_product_data['details'], $old_product['detail_id']);

        $this->db->query("UPDATE `product` SET `title` = " . $new_product_data['title'] . " WHERE `id` = " . $old_product['id'] . ";");
        Logger::debug("Продукт №" . $this->db->insert_id . " был успешно обновлен");
    }
    
    /**
     * Сохраняет цену
     *
     * @param  array $price
     * @return integer
     */
    private function savePrice(array $price)
    {
        $this->db->query("INSERT INTO `prices` (`price`, `currency`) VALUES ('" . $price['amount'] . "', '" . $price['currency'] . "');");
        
        return $this->db->insert_id;
    }
    
    /**
     * Сохраняет характеристки
     *
     * @param  array $details
     * @return integer
     */
    private function saveDetails(array $details)
    {
        $this->db->query("INSERT INTO `details` (`detail`) VALUES ('" . json_encode($details) . "');");
        
        return $this->db->insert_id;
    }
    
    /**
     * Обновляет цену
     *
     * @param  array $price
     * @param  integer $id
     * @return void
     */
    private function updatePrice(array $price, $id)
    {
        $this->db->query("UPDATE `prices` SET `amount` = " . $price['amount'] . ", `currency` = '" . $price['currency'] . "' WHERE `id` = " . $id . ";");        
    }
        
    /**
     * Обновляет характеристики
     *
     * @param  array $details
     * @param  integer $id
     * @return void
     */
    private function updateDetails(array $details, $id)
    {
        $this->db->query("UPDATE `details` SET `detail` = '" . json_encode($details) . "' WHERE `id` = " . $id . ";");        
    }
}