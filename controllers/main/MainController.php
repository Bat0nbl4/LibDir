<?php

namespace controllers\main;

use controllers\Controller;
use core\data_base\DB;
use core\rendering\View;

class MainController extends Controller {
    public function index(int $page = 1) {
        $books_on_page = 12;

        $books_count = DB::query()
            ->from("book")
            ->select(["COUNT(id)"])
            ->get()[0]["COUNT(id)"];
        $page_count = ceil($books_count / $books_on_page);

        $tops = DB::query()
            ->from("book")
            ->select([
                "book.*"
            ])
            ->orderBy("rating", "DESC")
            ->limit(10)
            ->get();

        $books = DB::query()
            ->from("book")
            ->select(["id", "cover_url"])
            ->orderBy("id", "DESC")
            ->offset(($page-1)*$books_on_page)
            ->limit($books_on_page)
            ->get();

        View::render("index", [
            "books" => $books,
            "page_count" => $page_count,
            "current_page" => $page,
            "tops" => $tops
        ]);
    }
}