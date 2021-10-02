<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Advertisement;
use app\models\User;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => "Kiss Roland"
        ];

        return $this->render('home', $params);
    }

    /**
     * @return array|false|string|string[]
     */
    public function advertisements()
    {
        $ads = Advertisement::getAll();

        return $this->render('advertisements', $ads);
    }

    /**
     * @return array|false|string|string[]
     */
    public function users()
    {
        $users = User::getAll();

        return $this->render('users', $users);
    }
}