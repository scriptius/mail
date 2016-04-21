<?php

namespace app\tests\phpunit;

require __DIR__.'/../../vendor/autoload.php';
require  __DIR__.'/../../models/User.php';

use app\models\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $user = new \app\models\User();
        $user->firstName = 'Иванов';
        $user->lastName = 'Иван';
        $user->patronymic = 'Иванович';
        $user->email = 'test@example.com';

        $this->assertNotNull($user->getName());
        $this->assertEquals('Иванов Иван Иванович', $user->getName());

        $user->firstName = '';

        $this->assertEquals('test@example.com', $user->getName());
        $this->assertInternalType('string', $user->getName());

    }

}