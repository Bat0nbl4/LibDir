<?php

namespace controllers\admin\order;

use core\data_base\DB;
use core\routing\Router;
use core\session\Session;

class OrderActionController extends \controllers\Controller
{
    public function put(int $id) {
        $order = DB::query()
            ->from("`order`")
            ->where("id", "=", $id)
            ->first();

        if (!$order) {
            Session::flash("old_input", $_POST);
            Router::redirect(Router::back(Router::route("index")));
            return;
        }

        $valid = true;
        if (empty($_POST["status"])) {
            $valid = false;
            Session::flash("input_errors.name", "Поле \"Статус\" обязательно для заполнения.");
        } elseif (!in_array($_POST["status"], ["Ожидает оплаты", "Собирается", "В пути", "Доставлен", "Получен"])) {
            $valid = false;
            Session::flash("input_errors.name", "Недопустимое значение статуса.");
        }

        if (!$valid) {
            Session::flash("old_input", $_POST);
            Router::redirect(Router::back(Router::route("index")));
            return;
        }

        DB::query()
            ->from("`order`")
            ->where("id", "=", $id)
            ->update([
                "status" => $_POST["status"],
            ]);

        Router::redirect(Router::back());
    }

    public function delete(int $id) {
        DB::query()
            ->from("`order`")
            ->where("id", "=", $id)
            ->delete();

        Router::redirect(Router::route("admin.order.list"));
    }
}