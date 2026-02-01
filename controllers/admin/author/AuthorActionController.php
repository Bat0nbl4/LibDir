<?php

namespace controllers\admin\author;

use core\data_base\DB;
use core\routing\Router;
use core\session\Session;

class AuthorActionController extends \controllers\Controller
{
    public function put(int $id) {
        $author = DB::query()
            ->from("author")
            ->where("id", "=", $id)
            ->first();

        if (!$author) {
            Session::flash("old_input", $_POST);
            Router::redirect(Router::back(Router::route("index")));
            return;
        }

        $valid = true;
        if (empty($_POST["surname"])) {
            $valid = false;
            Session::flash("input_errors.surname", "Поле \"Фаилия\" обязательно для заполнения.");
        }
        if (empty($_POST["name"])) {
            $valid = false;
            Session::flash("input_errors.name", "Поле \"Имя\" обязательно для заполнения.");
        }

        if (!$valid) {
            Session::flash("old_input", $_POST);
            Router::redirect(Router::back(Router::route("index")));
            return;
        }

        DB::query()
            ->from("author")
            ->where("id", "=", $id)
            ->update([
                "surname" => $_POST["surname"],
                "name" => $_POST["name"],
                "patronymic" => $_POST["patronymic"] ?? null,
                "about" => $_POST["about"] ?? null,
                "birthdate" => empty($_POST["birthdate"]) ? null : $_POST["birthdate"],
                "diedate" => empty($_POST["diedate"]) ? null : $_POST["diedate"],
            ]);

        Router::redirect(Router::back());
    }

    public function store() {

        $valid = true;
        if (empty($_POST["surname"])) {
            $valid = false;
            Session::flash("input_errors.surname", "Поле \"Фаилия\" обязательно для заполнения.");
        }
        if (empty($_POST["name"])) {
            $valid = false;
            Session::flash("input_errors.name", "Поле \"Имя\" обязательно для заполнения.");
        }
        if (!$valid) {
            Session::flash("old_input", $_POST);
            Router::redirect(Router::back(Router::route("index")));
            return;
        }

        DB::query()
            ->from("author")
            ->set([
                "surname" => $_POST["surname"],
                "name" => $_POST["name"],
                "patronymic" => $_POST["patronymic"] ?? null,
                "about" => $_POST["about"] ?? null,
                "birthdate" => empty($_POST["birthdate"]) ? null : $_POST["birthdate"],
                "diedate" => empty($_POST["diedate"]) ? null : $_POST["diedate"],
            ])
            ->insert();

        Router::redirect(Router::route("admin.author.list"));
    }

    public function delete(int $id) {
        DB::query()
            ->from("author")
            ->where("id", "=", $id)
            ->delete();

        Router::redirect(Router::route("admin.author.list"));
    }
}