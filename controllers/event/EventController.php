<?php

namespace controllers\user;

use controllers\Controller;
use core\data_base\DB;
use core\rendering\View;
use core\session\Session;

class EventController extends Controller {
    public function list($page = 1) {
        $events_on_page = 6;

        $events_count = DB::query()
            ->from("event")
            ->select(["COUNT(id)"])
            ->get()[0]["COUNT(id)"];
        $page_count = ceil($events_count / $events_on_page);

        $events = DB::query()
            ->from("event")
            ->select([
                "event.*",
                "event_status.name as status",
                "event_status.style as status_style"
            ])
            ->join("event_status", "event_status.id", "=", "event.status_id")
            ->orderBy("id", "DESC")
            ->offset(($page-1)*$events_on_page)
            ->limit($events_on_page)
            ->get();

        View::render("event/list", [
            "events" => $events,
            "page_count" => $page_count,
            "current_page" => $page,
        ]);

    }

    public function show($id) {
        $event = DB::query()
            ->from("event")
            ->select([
                "event.*",
                "event_status.name as status",
                "event_status.style as status_style"
            ])
            ->join("event_status", "event_status.id", "=", "event.status_id")
            ->where("event.id", "=", $id)
            ->first();

        $is_appointed = false;
        if (Session::has("user")) $is_appointed = !empty(DB::query()->from("appoint")->where("user_id", "=", Session::get("user.id"))->where("event_id", "=", $event["id"])->first());

        View::render("event/show", ["event" => $event, "is_appointed" => $is_appointed]);
    }
}