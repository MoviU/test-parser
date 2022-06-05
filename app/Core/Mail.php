<?php
namespace App\Core;

class Mail
{
    public static $to      = CONTACT_MAIL;
    public static $subject = 'Parser Alert';
    public static $message = '';
    public static $headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    public static function sendAlertMail()
    {
        if (self::$to) {
            mail(self::$to, self::$subject, self::$message, self::$headers);
            Logger::warning('Сообщение об ошибке было отправлено на почту ' . self::$to);
        } else {
            Logger::error('В конфиге не указана почта для контакта');
        }
    }
}