<?php

namespace controllers\admin\author;

use core\data_base\DB;
use core\rendering\View;

class AuthorController extends \controllers\Controller
{
    public function list(int $page = 1)
    {
        $elem_on_page = 20;

        $authors_count = DB::query()
            ->from("author")
            ->select(["COUNT(id)"])
            ->get()[0]["COUNT(id)"];
        $page_count = ceil($authors_count / $elem_on_page);

        $authors = DB::query()
            ->from("author")
            ->orderBy("id", "DESC")
            ->offset(($page - 1) * $elem_on_page)
            ->limit($elem_on_page)
            ->get();

        View::template("admin_panel");
        View::render("admin/author/list", [
            "authors" => $authors,
            "page_count" => $page_count,
            "current_page" => $page,
        ]);
    }

    public function edit(int $id) {
        $author = DB::query()
            ->from("author")
            ->where("id", "=", $id)
            ->first();

        if (!$author) {
            View::render("catch/404");
        }

        View::template("admin_panel");
        View::render("admin/author/edit", ["author" => $author]);
    }

    public function create() {
        View::template("admin_panel");
        View::render("admin/author/create");
    }
}