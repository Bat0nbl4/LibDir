<?php

namespace controllers\user;

use controllers\Controller;
use core\data_base\DB;
use core\rendering\View;
use core\session\Session;

class UserController extends Controller {
    public function login() {
        View::render("user/login");
    }

    public function registration() {
        View::render("user/registration");
    }

    public function lk($page = 1) {
        $events_on_page = 6;

        $events_count = DB::query()
            ->from("event")
            ->join("appoint", "appoint.user_id", "=", Session::get("user.id"))
            ->select(["COUNT(event.id)"])
            ->get()[0]["COUNT(event.id)"];

        $page_count = ceil($events_count / $events_on_page);

        $events = DB::query()
            ->from("event")
            ->select([
                "event.*",
                "event_status.name as status",
                "event_status.style as status_style"
            ])
            ->join("event_status", "event_status.id", "=", "event.status_id")
            ->join("appoint", "appoint.user_id", "=", Session::get("user.id"))
            ->orderBy("id", "DESC")
            ->offset(($page-1)*$events_on_page)
            ->limit($events_on_page)
            ->get();

        View::render("user/lk", [
            "events" => $events,
            "page_count" => $page_count,
            "current_page" => $page,
        ]);
    }
}