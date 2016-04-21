<?php

namespace app\models;
class UserForm
    extends \yii\base\Model
{
    public $login;
    public $firstName;
    public $lastName;
    public $patronymic;
    public $email;

    public function rules()
    {
        return [
            [['login', 'email'], 'required'],
            ['email', 'email'],
        ];
    }
}