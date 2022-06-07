<?php
namespace App\Core;
use Idearia\Logger;

class Mail
{
    public static $to      = CONTACT_MAIL;
    public static $subject = 'Parser Alert';
    public static $message = '';
    public static $from = MAIL_FROM;

    public static function sendAlertMail()
    {
        if (self::$to && self::$from) {
            $headers = 'From: ' . self::$from . "\r\n" .
            'Reply-To: ' . self::$from . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail(self::$to, self::$subject, self::$message, $headers);
            Logger::warning('Сообщение об ошибке было отправлено на почту ' . self::$to);
        } else {
            Logger::error('В конфиге не указана почта для контакта или отправки');
        }
    }
}