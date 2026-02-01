<?php

namespace controllers\basket;

use controllers\Controller;
use core\data_base\DB;
use core\routing\Router;
use core\session\Session;

class BasketActionController extends Controller
{
    /**
     * @param int $id id книги
     * @param int $count колчиество для добавления
     *
     * @return void
     */
    public function add(int $id, int $count = 1) {
        if ($count < 0) {
            Router::redirect(Router::back());
        }

        if (!Session::has("basket.books.{$id}")) {
            $book = DB::query()
                ->from("book")
                ->select(["id", "cover_url"])
                ->where("id", "=", $id)
                ->first();

            $price = DB::query()
                ->from("price")
                ->where("book_id", "=", $id)
                ->orderBy("id", "DESC")
                ->first()["price"] ?? null;

            Session::set("basket.books.{$id}.count", $count);
            Session::set("basket.books.{$id}.cover_url", $book["cover_url"]);
            Session::set("basket.books.{$id}.price", $price);
        } else {
            Session::set("basket.books.{$id}.count", Session::get("basket.books.{$id}.count") + $count);
        }

        Router::redirect(Router::route("user.basket"));
    }

    /**
     * @param int $id id книги
     * @param int $count колчиество для удаления. 0 полностью убирает книгу из корзины.
     *
     * @return void
     */
    public function remove(int $id, int $count = 1) {
        if ($count < 0 or !Session::has("basket.books.{$id}")) {
            Router::redirect(Router::back());
        } elseif ($count === 0 or Session::get("basket.books.{$id}.count") <= $count) {
            Session::remove("basket.books.{$id}");
        } else {
            Session::set("basket.books.{$id}.count", Session::get("basket.books.{$id}.count") - $count);
        }

        if (empty(Session::get("basket.books"))) {
            Session::remove("basket.books");
        }

        if (empty(Session::get("basket"))) {
            Session::remove("basket");
        }

        Router::redirect(Router::route("user.basket"));
    }

    public function order() {
        if (!Session::has("basket.books")) {
            Router::redirect(Router::route("user.basket"));
        }

        $order_id = DB::query()
            ->from("`order`")
            ->set([
                "user_id" => Session::get("user.id"),
                "created_at" => date("Y-m-d H:i:s")
            ])
            ->insert();

        $values = "";
        $total = 0;
        foreach (Session::get("basket.books") as $key => $value) {
            $price = DB::query()
                ->from("price")
                ->where("book_id", "=", $key)
                ->first();
            $total += $price["price"] * $value["count"];
            $values .= "({$key}, {$order_id}, {$price["id"]}, {$value["count"]}), ";
        }

        DB::manualQuery("
            INSERT INTO `order_item` (book_id, order_id, price_id, `count`)
            VALUES".substr($values, 0, -2)
        );

        DB::query()
            ->from("`order`")
            ->where("id", "=", $order_id)
            ->update(["total" => $total]);

        Session::remove("basket");

        Router::redirect(Router::route("lk"));
    }
}