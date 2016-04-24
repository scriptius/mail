<?php

namespace app\mail;


class Mailer
{
    public static function Send($template, $subject)
    {
        // Create the message
        $emailBody = file_get_contents('C:\OpenServer\domains\mail\templates\\'.$template.'.html');
        $message = new \Swift_Message();
        $message->setSubject($subject)
            ->setFrom(array('levik04122008@yandex.ru' => 'Mamonov Viktor'))
            ->setTo(array('masevius@rambler.ru' => 'A name'))
            ->setBody($emailBody, "text/html");

// Create the Transport
        $config = \Yii::$app->params;
        $transport = (new \Swift_SmtpTransport('mailtrap.io', 465))
            ->setUsername($config['emailAdmin']['login'])
            ->setPassword($config['emailAdmin']['pass']);

        $mailer = new \Swift_Mailer($transport);

// Send the message
        return ($mailer->send($message))? true : false;
    }
}