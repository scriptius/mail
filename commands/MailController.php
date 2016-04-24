<?php


namespace app\commands;

use app\mail\Mailer;
use yii\console\Controller;

class MailController extends Controller
{
    protected function actionValidateEmail($email)
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return filter_var($email, FILTER_VALIDATE_EMAIL);

    }

    public function beforeSend()
    {
        $forSend  = (new \yii\db\Query())
            ->select(['email', 'templates', 'text'])
            ->from('MailShedule')
//            ->where(['id' => $data->userId])
            ->where(['status' => 'waiting'])
            ->all();

        return $forSend;
    }

    public function  actionSend()
    {
        $forSend = $this->beforeSend();
        $mail = new Mailer();
        $status = [];
        foreach ($forSend as $sender) {
            if (true == $this->actionValidateEmail($sender['email']) && $mail->Send($sender['templates'], $sender['text'])) {
                $status[$sender['email']] = 'successfully';
            } else {
                $status[$sender['email']] = 'failure';
            }
        }
        $this->afterSend($status);

    }

    public function afterSend(array $status)
    {
        if (!empty($status)){
            foreach($status as $email => $value){
                \Yii::$app->db->createCommand()
                    ->update('MailShedule', [
                        'status' => $value,
                    ],
                        'email=:email',
                        ['email' => $email ])
                    ->execute();
            }
        }
    }


}