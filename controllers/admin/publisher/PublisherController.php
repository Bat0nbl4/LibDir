<?php

namespace controllers\admin\publisher;

use core\data_base\DB;
use core\rendering\View;

class PublisherController extends \controllers\Controller
{
    public function list(int $page = 1)
    {
        $elem_on_page = 20;

        $count = DB::query()
            ->from("publisher")
            ->select(["COUNT(id)"])
            ->get()[0]["COUNT(id)"];
        $page_count = ceil($count / $elem_on_page);

        $publishers = DB::query()
            ->from("publisher")
            ->orderBy("id", "DESC")
            ->offset(($page - 1) * $elem_on_page)
            ->limit($elem_on_page)
            ->get();

        View::template("admin_panel");
        View::render("admin/publisher/list", [
            "publishers" => $publishers,
            "page_count" => $page_count,
            "current_page" => $page,
        ]);
    }

    public function edit(int $id) {
        $publisher = DB::query()
            ->from("publisher")
            ->where("id", "=", $id)
            ->first();

        if (!$publisher) {
            View::render("catch/404");
        }

        View::template("admin_panel");
        View::render("admin/publisher/edit", ["publisher" => $publisher]);
    }

    public function create() {
        View::template("admin_panel");
        View::render("admin/publisher/create");
    }
}