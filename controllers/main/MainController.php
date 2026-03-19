<?php

namespace controllers\main;

use controllers\Controller;
use core\rendering\View;

class MainController extends Controller {
    public function index() {
        View::render("index");
    }
}