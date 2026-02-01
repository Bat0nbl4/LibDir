<?php

namespace controllers\basket;

use controllers\Controller;
use core\rendering\View;

class BasketController extends Controller {
    public function index() {
        View::render("user/basket/index");
    }
}