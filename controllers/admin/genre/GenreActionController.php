<?php

namespace controllers\admin\genre;

use core\data_base\DB;
use core\routing\Router;
use core\session\Session;

class GenreActionController extends \controllers\Controller
{
    public function put(int $id) {
        $genre = DB::query()
            ->from("genre")
            ->where("id", "=", $id)
            ->first();

        if (!$genre) {
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
            ->from("genre")
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
            ->from("genre")
            ->set([
                "name" => $_POST["name"],
            ])
            ->insert();

        Router::redirect(Router::route("admin.genre.list"));
    }

    public function delete(int $id) {
        DB::query()
            ->from("genre")
            ->where("id", "=", $id)
            ->delete();

        Router::redirect(Router::route("admin.genre.list"));
    }
}