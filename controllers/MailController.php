<?php
/**
 * Created by PhpStorm.
 * User: v.mamonov
 * Date: 22.04.2016
 * Time: 10:09
 */

namespace app\controllers;

use yii\web\Controller;

class MailController
    extends Controller
{
    public function addShedule()
    {
        $shedule = (new \yii\db\Query())
            ->select('id')
            ->from('Users')
            ->where('login like \'Admin\'')
            ->one();

        var_dump($shedule);


        die;

    }

    public function actionSend()
    {
        echo 111;

        die;

//        $this->update('Users', ['roleId' => $whatAdminId[0]['id']], ['login' => 'Admin']);

//       var_dump(shell_exec('C:\OpenServer\modules\php\PHP-7-x64\php.exe yii mail/send'));
    }

}