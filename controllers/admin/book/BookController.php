<?php

namespace controllers\admin\book;

use controllers\Controller;
use core\data_base\DB;
use core\rendering\View;
use controllers\helpers\Book;

class BookController extends Controller {

    public function list(int $page = 1) {
        $elem_on_page = 20;

        $books_count = DB::query()
            ->from("book")
            ->select(["COUNT(id)"])
            ->get()[0]["COUNT(id)"];
        $page_count = ceil($books_count / $elem_on_page);

        $books = DB::query()
            ->from("book")
            ->select(["id", "title"])
            ->orderBy("id", "DESC")
            ->offset(($page-1)*$elem_on_page)
            ->limit($elem_on_page)
            ->get();

        View::template("admin_panel");
        View::render("admin/book/list", [
            "books" => $books,
            "page_count" => $page_count,
            "current_page" => $page,
        ]);
    }

    public function edit(int $id) {
        $book = Book::get_book_by_id($id);

        if (!$book) {
            View::render("catch/404");
        }

        $authors = DB::query()
            ->from("author")
            ->get();

        $publishers = DB::query()
            ->from("publisher")
            ->get();

        $batchs = DB::query()
            ->from("batch")
            ->get();

        $genres = DB::query()
            ->from("genre")
            ->get();

        View::template("admin_panel");
        View::render("admin/book/edit", [
            "book" => $book,
            "authors" => $authors,
            "publishers" => $publishers,
            "batchs" => $batchs,
            "genres" => $genres
        ]);
    }

    public function create() {
        $authors = DB::query()
            ->from("author")
            ->get();

        $publishers = DB::query()
            ->from("publisher")
            ->get();

        $batchs = DB::query()
            ->from("batch")
            ->get();

        $genres = DB::query()
            ->from("genre")
            ->get();

        View::template("admin_panel");
        View::render("admin/book/create", [
            "authors" => $authors,
            "publishers" => $publishers,
            "batchs" => $batchs,
            "genres" => $genres
        ]);
    }
}