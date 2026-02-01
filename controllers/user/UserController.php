<?php

namespace controllers\user;

use controllers\Controller;
use core\data_base\DB;
use core\helpers\Str;
use core\rendering\View;
use core\session\Session;

class UserController extends Controller {
    public function reg() {
        View::render("user/reg");
    }

    public function login() {
        View::render("user/login");
    }

    public function lk(int $page = 1) {
        $elem_on_page = 10;

        $order_count = DB::query()
            ->from("`order`")
            ->select(["COUNT(id)"])
            ->get()[0]["COUNT(id)"];
        $page_count = ceil($order_count / $elem_on_page);

        $orders = DB::query()
            ->from("`order`")

            ->select([
                "`order`.id",
                "`order`.created_at",
                "`order`.status",
                "SUM(price.price) as `sum`"
            ])
            ->where("`order`.user_id", "=", Session::get("user.id"))
            ->join("order_item", "order_id", "=", "`order`.id")
            ->join("price", "order_item.price_id", "=", "price.id")
            ->orderBy("id", "DESC")
            ->offset(($page-1)*$elem_on_page)
            ->limit($elem_on_page)
            ->groupBy(["`order`.id"])
            ->get();

        View::render("user/lk", [
            "orders" => $orders,
            "page_count" => $page_count,
            "current_page" => $page
        ]);
    }
}