<?php

namespace controllers\helpers;

use controllers\Controller;
use core\data_base\DB;

abstract class Book extends Controller {
    public static function get_book_by_id(int $id) : array|null {
        $book = DB::query()
            ->from("book")
            ->select([
                "book.*",
            ])
            ->where("book.id", "=", $id)
            ->first();

        if (!$book) {
            http_response_code(404);
            return null;
        }

        $book["publisher"] = DB::query()
            ->from("publisher")
            ->where("id", "=", $book["publisher_id"])
            ->first() ?? null;

        $book["batch"] = DB::query()
            ->from("batch")
            ->where("id", "=", $book["batch_id"])
            ->first() ?? null;

        $book["author"] = DB::query()
            ->from("author")
            ->where("id", "=", $book["author_id"])
            ->first() ?? null;

        $book["price"] = DB::query()
            ->from("price")
            ->where("book_id", "=", $id)
            ->orderBy("id", "DESC")
            ->first()["price"] ?? null;

        $book["genre"] = DB::query()
            ->from("genre")
            ->where("id", "=", $book["genre_id"])
            ->first()["name"] ?? null;

        return $book;
    }
}