Сайт находится по адресу http://mayarossa.ru

Самая длинная цепочка Yii::$app->getDb()->schema->db->getTableSchema()

            Тестирвание массива из элементов int
            
            php 7.0
        Выделено памяти на начало теста: 1 720 648
        Выделено памяти на конец теста: 28 983 720
        Для одного элемента типа int в массиве из 1млн элементов : 27

           php 5.6
        Выделено памяти на начало теста: 1 657 168
        Выделено памяти на конец теста: 85 851 744
        Для одного элемента типа int в массиве из 1млн элементов : 84

        Итого производительность php7 в 3 раза выше чем php5.6.
        Как написано на хабре данная производительность обусловлена
        более эффективный Hashtable.


            Тестирование класса
            php 7.0
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

