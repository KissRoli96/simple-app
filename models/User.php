<?php

namespace app\models;

use app\core\ActiveRecord;

class User extends ActiveRecord
{

    public int $id;

    public string $name;

    /**
     * @return string
     */
    public static function getTable(): string
    {
        return 'users';
    }
}