<?php

namespace controllers\main;

use controllers\Controller;
use core\data_base\DB;
use core\rendering\View;

class MainController extends Controller {
    public function index() {
        $events = DB::query()
            ->from("event")
            ->select([
                "event.*",
                "event_status.name as name",
                "event_status.style as style"
            ])
            ->join("event_status", "event_status.id", "=", "event.status_id")
            ->limit(4)
            ->orderBy("id", "DESC")
            ->get();

        View::render("index", ["events" => $events]);
    }

    public function about() {
        View::render("about");
    }

    public function contacts() {
        View::render("contacts");
    }

    public function residents() {
        View::render("residents");
    }
}