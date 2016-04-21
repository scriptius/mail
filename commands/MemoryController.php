<?php
/**
 * Created by PhpStorm.
 * User: Victor_PC
 * Date: 14.04.2016
 * Time: 21:41
 */

namespace app\commands;

use yii\console\Controller;

class ClassTest
{
    public $value;
    public $self;
}

class MemoryController
    extends Controller
{
    public $value;
    public $self;

    public function actionTestInt()
    {
        /* php 7.0
        Выделено памяти на начало теста: 1 720 648
        Выделено памяти на конец теста: 28 983 720

        Для одного элемента типа int в массиве из 1млн элементов : 27

           php 5.6
        Выделено памяти на начало теста: 1 657 168
        Выделено памяти на конец теста: 85 851 744
        Для одного элемента типа int в массиве из 1млн элементов : 84

        Итого производительность php7 в 3 раза выше чем php5.6
        */

        $memoryBefore = memory_get_usage();
        echo 'memory before test:' . $memoryBefore . PHP_EOL;
        $i = 1;
        $j = 1000000;
        $test = range(1, $j);
        $memoryAfter = memory_get_usage();
        echo 'memory after test:' . $memoryAfter . PHP_EOL;
        echo 'array consist from ' . $j . ' elements' . PHP_EOL;
        echo 'One element type of int, used ' . ($memoryAfter - $memoryBefore) / $j . ' Bytes';
//        print_r(get_declared_classes());
//        var_dump($new = new \ReflectionClass('yii\base\Object'));
//        var_dump($new::IS_FINAL);
    }

    public function actionTestClass()
    {
        /* php 7.0
           Выделено памяти на начало теста: 1 720 672
           Выделено памяти на конец теста: 123 269 744
           Итого на 1млн объектов: 121 549 072
           Каждые 500 итераций дополнительно выделялось: 44 000

            php5.6
           Выделено памяти на начало теста: 1 657 232
           Выделено памяти на конец теста: 199 374 864
           Итого на 1млн объектов: 197 717 632
           Каждые 500 итераций дополнительно выделялось: 80 000

           Итого производительность php7 в 2 раза выше чем php5.6
         */
        $memoryBefore = memory_get_usage();
        $i = 1000000;
        $j = 1;
        do {
            $obj = 'class' . $j;
            $$obj = new ClassTest;
            $$obj->value = rand();
            $$obj->self = $$obj;

            if (0 === $j % 500) {
                echo 'Allocated memory after ' . $j . ' iteration: ' . memory_get_usage() . ' bytes' . PHP_EOL;
                echo 'Total memory on a single object: ' . round((memory_get_usage() - $memoryBefore) / $j) . ' bytes' . PHP_EOL;
                echo '*************' . PHP_EOL;
            }
            ++$j;
        }
        while ($j < $i);

        $memoryAfter = memory_get_usage();

        echo 'memory before test:' . $memoryBefore . PHP_EOL;
        echo 'memory after test:' . $memoryAfter . PHP_EOL;
        echo 'Total objects ' . $j . ' elements' . PHP_EOL;
        echo 'One element type of int, used ' . round((memory_get_usage() - $memoryBefore) / $j) . ' Bytes';
    }

}