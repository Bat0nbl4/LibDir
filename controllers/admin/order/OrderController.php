<?php

namespace controllers\admin\order;

use core\data_base\DB;
use core\rendering\View;

class OrderController extends \controllers\Controller
{
    public function list(int $page = 1)
    {
        $elem_on_page = 20;

        $count = DB::query()
            ->from("`order`")
            ->select(["COUNT(id)"])
            ->get()[0]["COUNT(id)"];
        $page_count = ceil($count / $elem_on_page);

        $orders = DB::query()
            ->from("`order`")
            ->select([
                "`order`.*",
                "user.name",
                "user.surname",
                "user.patronymic",
            ])
            ->orderBy("id", "DESC")
            ->join("user", "user.id", "=", "`order`.user_id")
            ->offset(($page - 1) * $elem_on_page)
            ->limit($elem_on_page)
            ->get();

        View::template("admin_panel");
        View::render("admin/order/list", [
            "orders" => $orders,
            "page_count" => $page_count,
            "current_page" => $page,
        ]);
    }

    public function edit(int $id) {
        $order = DB::query()
            ->from("`order`")
            ->where("id", "=", $id)
            ->first();

        if (!$order) {
            View::render("catch/404");
        }

        $order_items = DB::query()
            ->from("order_item")
            ->select([
                "price.price",
                "order_item.count",
                "book.id as book_id",
                "book.cover_url"
            ])
            ->where("order_id", "=", $id)
            ->join("book", "book.id", "=", "order_item.book_id")
            ->join("price", "price.id", "=", "order_item.price_id")
            ->get();

        View::template("admin_panel");
        View::render("admin/order/edit", ["order" => $order, "order_items" => $order_items]);
    }
}