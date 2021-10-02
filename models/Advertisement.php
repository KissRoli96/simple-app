<?php

namespace app\models;

use app\core\ActiveRecord;

class Advertisement extends ActiveRecord
{
    public int $id;

    public int $userid;

    public string $title;

    /**
     * @return string
     */
    public static function getTable(): string
    {
        return "advertisements";
    }

    /**
     * @return array|mixed|null
     */
    public function getUser() {
        try {
            $user = User::getById($this->userid);

            if (empty($user)) {
                throw new \Exception("User not found");
            }

            return $user;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }
}
