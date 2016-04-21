<?php
/**
 * Created by PhpStorm.
 * User: v.mamonov
 * Date: 11.04.2016
 * Time: 14:56
 */

namespace app\models;

use yii\db\ActiveRecord;
use app\components\Annotations;

class User extends Annotations
//    extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName()
    {
        return 'Users';
    }

    public function rules()
    {
        return [
            [['firstName', 'lastName', 'patronymic', 'login', 'email', 'roleId', 'status'], 'safe']
        ];
    }

    /**
     * @template "$firstName $lastName"
     *
     */
    public function getFullName()
    {
        return parent::getFullName();
/*
        if (!empty($this->firstName) && !empty($this->lastName)){
            return (!empty($this->patronymic))? implode(' ', [$this->firstName, $this->lastName, $this->patronymic]) :
                                                implode(' ', [$this->firstName, $this->lastName]);
        }

        return $this->email;

*/


//        return
//            (!empty($this->firstName) && !empty($this->lastName))?
//                implode(' ', [$this->firstName, $this->lastName, $this->patronymic]) :
//                   (!empty($this->firstName) && !empty($this->lastName) && empty($this->patronymic))?
//                         implode(' ', [$this->firstName, $this->lastName]) :
//                              $this->email;
    }

}
