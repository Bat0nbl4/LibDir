<?php

namespace controllers\admin\genre;

use core\data_base\DB;
use core\rendering\View;

class GenreController extends \controllers\Controller
{
    public function list(int $page = 1)
    {
        $elem_on_page = 20;

        $count = DB::query()
            ->from("genre")
            ->select(["COUNT(id)"])
            ->get()[0]["COUNT(id)"];
        $page_count = ceil($count / $elem_on_page);

        $genres = DB::query()
            ->from("genre")
            ->orderBy("id", "DESC")
            ->offset(($page - 1) * $elem_on_page)
            ->limit($elem_on_page)
            ->get();

        View::template("admin_panel");
        View::render("admin/genre/list", [
            "genres" => $genres,
            "page_count" => $page_count,
            "current_page" => $page,
        ]);
    }

    public function edit(int $id) {
        $genre = DB::query()
            ->from("genre")
            ->where("id", "=", $id)
            ->first();

        if (!$genre) {
            View::render("catch/404");
        }

        View::template("admin_panel");
        View::render("admin/genre/edit", ["genre" => $genre]);
    }

    public function create() {
        View::template("admin_panel");
        View::render("admin/genre/create");
    }
}