<?php
namespace App\Core;
use Idearia\Logger;

class Mail
{
    public static $to      = CONTACT_MAIL;
    public static $subject = 'Parser Alert';
    public static $message = '';

    public function sendAlertMail()
    {
        if (self::$to) {
            $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail(self::$to, self::$subject, self::$message, $headers);
            Logger::warning('Сообщение об ошибке было отправлено на почту ' . self::$to);
        } else {
            Logger::error('В конфиге не указана почта для контакта');
        }
    }
}