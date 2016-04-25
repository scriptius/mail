<?php

namespace app\controllers;

use yii\web\Controller;

class MailController
    extends Controller
{
    public function addShedule($data)
    {
        $shedule = (new \yii\db\Query())
            ->select('email')
            ->from('Users')
            ->where(['id' => $data->userId])
            ->one();

        if (true == $shedule) {
            \Yii::$app->db->createCommand()
                ->insert('MailShedule', [
                    'userId' => $data->userId,
                    'templates' => $data->template,
                    'text' => $data->text,
                    'status' => 'waiting',
                    'email' => $shedule['email']
                ])->execute();

            return \Yii::$app->db->getLastInsertID();
        } else {
            throw new \Exception('User is not found in the database');
        }
    }

    public function actionStatus()
    {
        $data = json_decode($_POST['data']);
        $result = (new \yii\db\Query())
            ->select('status')
            ->from('MailShedule')
            ->where(['id' => $data->numberInStack])
            ->one();
        return $result['status'];
    }

    public function actionSend()
    {
        $data = json_decode($_POST['data']);
        try {
            $lastInsertId = $this->addShedule($data);
            \Yii::$app->response->statusCode = 200;
            return $lastInsertId;

        } catch (\Exception $e) {
            return $e;
        }
    }
}