<?php

namespace controllers\user;

use controllers\Controller;
use core\rendering\View;

class EventController extends Controller {
    public function list() {
        View::render("event/list");
    }

    public function show() {
        View::render("event/show");
    }
}