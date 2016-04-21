<?php

namespace app\mail;


class Mailer
{
    public static function Send($textMessage = 'test', $subject = 'Оповещение системы')
    {
        // Create the message
        $message = new \Swift_Message();
        $message->setSubject($subject)
            ->setFrom(array('levik04122008@yandex.ru' => 'Mamonov Viktor'))
            ->setTo(array('masevius@rambler.ru' => 'A name'))
            ->setBody($textMessage);

// Create the Transport
        $config = \Yii::$app->params;
        $transport = (new \Swift_SmtpTransport('mailtrap.io', 465))
            ->setUsername($config['emailAdmin']['login'])
            ->setPassword($config['emailAdmin']['pass']);

        $mailer = new \Swift_Mailer($transport);

// Send the message
        $result = $mailer->send($message);
    }
}