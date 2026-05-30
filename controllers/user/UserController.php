<?php

namespace controllers\user;

use controllers\Controller;
use core\rendering\View;

class UserController extends Controller {
    public function login() {
        View::render("user/login");
    }

    public function registration() {
        View::render("user/registration");
    }

    public function lk() {
        View::render("user/lk");
    }
}