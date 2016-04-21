<?php
/**
 * Created by PhpStorm.
 * User: v.mamonov
 * Date: 18.04.2016
 * Time: 13:42
 */

namespace app\tests\phpunit;

require __DIR__.'/../../vendor/autoload.php';
require  __DIR__.'/../../commands/MailController.php';

use app\commands\MailController;

class MailTest
    extends \PHPUnit_Framework_TestCase
{
    public function testValidateEmail()
    {
        $mail = new MailController('test','test');
        $reflector = new \ReflectionMethod($mail, 'actionValidateEmail');
        if($reflector->isProtected()){
            $reflector->setAccessible(true);
        }
        $this->assertEquals(1, $reflector->invoke($mail,'test@rambler.ru'));
    }
}