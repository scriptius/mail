<?php


namespace app\commands;

use app\mail\Mailer;
use yii\console\Controller;

class MailController extends Controller
{
    protected function actionValidateEmail($email)
    {
       return preg_match( "/^[a-z0-9_-]{1,20}@(([a-z0-9-]+\.)+(com|net|org|mil|".
           "edu|gov|arpa|info|biz|inc|name|[a-z]{2})|[0-9]{1,3}\.[0-9]{1,3}\.[0-".
           "9]{1,3}\.[0-9]{1,3})$/is", $email)? true : false;

    }

    public function  actionSend()
    {
        echo $this->actionValidateEmail();
        die;
        $mail = new Mailer();
        $mail->Send();
//        return $this->render('mail');
    }

}