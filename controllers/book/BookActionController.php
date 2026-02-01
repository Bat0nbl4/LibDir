<?php

namespace controllers\book;

use controllers\Controller;
use core\data_base\DB;
use core\routing\Router;
use core\session\Session;

class BookActionController extends Controller
{
    public function store_review() {
        $check = DB::query()
            ->from("feedback")
            ->where("book_id", "=", $_POST["id"])
            ->where("user_id", "=", Session::get("user")["id"])
            ->get();

        if (!$check) {
            DB::query()
                ->from("feedback")
                ->set([
                    "user_id" => Session::get("user")["id"],
                    "book_id" => $_POST["id"],
                    "estimation" => $_POST["estimation"],
                    "comment" => $_POST["comment"]
                ])
                ->insert();
        }

        $feedback_avg = DB::query()
            ->from("feedback")
            ->select(["AVG(estimation) as AVG"])
            ->where("book_id", "=", $_POST["id"])
            ->get();

        DB::query()
            ->from("book")
            ->where("id", "=", $_POST["id"])
            ->set([
                "rating" => $feedback_avg[0]["AVG"]
            ])
            ->update();

        Router::redirect(Router::route("book.show", ["id" => $_POST["id"]]));
    }

    public function reserve(int $id) {
        $check = DB::query()
            ->from("booked_book")
            ->select(["id"])
            ->where("book_id", "=", $id)
            ->where("user_id", "=", Session::get("user")["id"])
            ->get();

        if (!$check) {
            DB::query()
                ->from("booked_book")
                ->set([
                    "user_id" => Session::get("user")["id"],
                    "book_id" => $id,
                    "booked_until" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 3 days'))
                ])
                ->insert();
        }

        Router::redirect(Router::route("show_book", ["id" => $id]));
    }

    public function chanel_reserve(int $id) {
        $check = DB::query()
            ->from("booked_book")
            ->select(["id"])
            ->where("book_id", "=", $id)
            ->where("user_id", "=", Session::get("user")["id"])
            ->get();

        if ($check) {
            DB::query()
                ->from("booked_book")
                ->where("book_id", "=", $id)
                ->where("user_id", "=", Session::get("user")["id"])
                ->delete();
        }

        Router::redirect(Router::route("show_book", ["id" => $id]));
    }
}