<?php

namespace controllers\admin\publisher;

use core\data_base\DB;
use core\routing\Router;
use core\session\Session;

class PublisherActionController extends \controllers\Controller
{
    public function put(int $id) {
        $publisher = DB::query()
            ->from("publisher")
            ->where("id", "=", $id)
            ->first();

        if (!$publisher) {
            Session::flash("old_input", $_POST);
            Router::redirect(Router::back(Router::route("index")));
            return;
        }

        $valid = true;
        if (empty($_POST["name"])) {
            $valid = false;
            Session::flash("input_errors.name", "Поле \"Название\" обязательно для заполнения.");
        }

        if (!$valid) {
            Session::flash("old_input", $_POST);
            Router::redirect(Router::back(Router::route("index")));
            return;
        }

        DB::query()
            ->from("publisher")
            ->where("id", "=", $id)
            ->update([
                "name" => $_POST["name"],
            ]);

        Router::redirect(Router::back());
    }

    public function store() {

        $valid = true;
        if (empty($_POST["name"])) {
            $valid = false;
            Session::flash("input_errors.name", "Поле \"Название\" обязательно для заполнения.");
        }
        if (!$valid) {
            Session::flash("old_input", $_POST);
            Router::redirect(Router::back(Router::route("index")));
            return;
        }

        DB::query()
            ->from("publisher")
            ->set([
                "name" => $_POST["name"],
            ])
            ->insert();

        Router::redirect(Router::route("admin.publisher.list"));
    }

    public function delete(int $id) {
        DB::query()
            ->from("publisher")
            ->where("id", "=", $id)
            ->delete();

        Router::redirect(Router::route("admin.publisher.list"));
    }
}