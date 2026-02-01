<?php

namespace controllers\book;

use controllers\helpers\Book;
use core\data_base\DB;
use core\rendering\View;
use core\session\Session;

class BookController {

    public function show(int $id) {
        $book = Book::get_book_by_id($id);

        if (!$book) {
            View::render("catch/404");
            return;
        }

        $feedback_avg = DB::query()
            ->from("feedback")
            ->select(["AVG(estimation) as AVG", "COUNT(*) as estimations_count"])
            ->where("book_id", "=", $id)
            ->get();

        $reviews = DB::query()
            ->from("feedback")
            ->select(["*"])
            ->where("book_id", "=", $id)
            ->where("comment", "!=", "")
            ->join("user", "user.id", "=", "user_id")
            ->get();

        if ($feedback_avg[0]["estimations_count"] == 0) {
            $feedback = null;
        } else {
            $feedback = DB::manualQuery('
            SELECT
                (
                SELECT COUNT(*)
                FROM feedback
                WHERE estimation = 1 AND book_id = '.$id.'
                ) as "estimation_1",
                (
                SELECT COUNT(*)
                FROM feedback
                WHERE estimation = 2 AND book_id = '.$id.'
                ) as "estimation_2",
                (
                SELECT COUNT(*)
                FROM feedback
                WHERE estimation = 3 AND book_id = '.$id.'
                ) as "estimation_3",
                (
                SELECT COUNT(*)
                FROM feedback
                WHERE estimation = 4 AND book_id = '.$id.'
                ) as "estimation_4",
                (
                SELECT COUNT(*)
                FROM feedback
                WHERE estimation = 5 AND book_id = '.$id.'
                ) as "estimation_5"
            ');
        }

        $isReviewed = false;

        if (Session::has("user")) {
            $isReviewed = DB::query()
                ->from("feedback")
                ->where("book_id", "=", $book["id"])
                ->where("user_id", "=", Session::get("user")["id"])
                ->first() != null;
        }

        View::render("book/book", [
            "book" => $book, "feedback" => $feedback[0] ?? [],
            "feedback_avg" => $feedback_avg[0]["AVG"],
            "estimations_count" => $feedback_avg[0]["estimations_count"],
            "reviews" => $reviews,
            "isReviewed" => $isReviewed
        ]);
    }

    public function search() {
        if (!$_POST["title"]) {
            View::render("book/search", ["message" => "Мы не можем найти книгу по пустому запросу"]);
            return;
        }

        $books = DB::query()
            ->from("book")
            ->select(["id", "cover_url"])
            ->where("title", "LIKE", "%".$_POST["title"]."%")
            ->get();

        Session::flash("search", $_POST["title"]);

        if (!$books) {
            View::render("book/search", ["message" => "Мы не смогли найти ни одну книгу по вашему запросу"]);
            return;
        }

        View::render("book/search", ["books" => $books, "search" => $_POST["title"]]);
    }
}