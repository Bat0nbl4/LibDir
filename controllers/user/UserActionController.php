<?php

namespace controllers\user;

use controllers\Controller;
use core\data_base\DB;
use core\rendering\View;
use core\routing\Router;
use core\security\Hash;
use core\session\Session;

class UserActionController extends Controller {
    private function save_old() {
        Session::flash("old", $_POST);
        Session::removeFlash("old.password");
        Session::removeFlash("old.password_confirmation");
    }

    private function drop_store() {
        $this->save_old();
        Router::redirect(Router::back());
    }

    private function session_store_user_data($user) {
        $role = DB::query()->from("role")->where("id", "=", $user["role_id"])->first();
        if (empty($role)) $role = DB::query()->from("role")->where("id", "=",1)->first();

        Session::set("user", $user);
        Session::set("user.role", $role);
    }

    public function store() {
        $is_valid = true;
        foreach (["name", "surname", "gender", "birthdate", "email", "phone", "password", "password_confirmation"] as $input) {
            if (empty($_POST[$input])) {
                $is_valid = false;
                Session::flash("errors.{$input}", "Это поле обязательно для заполнения");
            }
        }
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $is_valid = false;
            Session::flash("errors.email", "Некоректный адресс почты");
        }
        if (strlen($_POST["password"]) < 8) {
            $is_valid = false;
            Session::flash("errors.password", "Пароль должен содержать 8 и более символов");
        }
        if ($_POST["password"] != $_POST["password_confirmation"]) {
            $is_valid = false;
            Session::flash("errors.password_confirmation", "Пароли не совпадают");
        }
        if (!$is_valid) $this->drop_store();

        if (!empty(DB::query()->from("user")->where("email", "=", $_POST["email"])->first())) {
            $is_valid = false;
            Session::flash("errors.email", "Этот адрес электроной почты уже используется");
            $this->drop_store();
        }
        if (!empty(DB::query()->from("user")->where("phone", "=", $_POST["phone"])->first())) {
            $is_valid = false;
            Session::flash("errors.email", "Этот номер телефона уже используется");
            $this->drop_store();
        }

        DB::query()
            ->from("user")
            ->insert([
                "name" => $_POST["name"],
                "surname" => $_POST["surname"],
                "patronymic" => $_POST["patronymic"],
                "gender" => $_POST["gender"],
                "birthdate" => $_POST["birthdate"],
                "email" => $_POST["email"],
                "phone" => "+7 ".$_POST["phone"],
                "password" => Hash::hashPassword($_POST["password"]),
                "role_id" => 1
            ]);

        $user = DB::query()
            ->from("user")
            ->where("email", "=", $_POST["email"])
            ->where("phone", "=", "+7 ".$_POST["phone"])
            ->orderBy("id", "DESC")
            ->first();
        unset($user["password"]);

        if (empty($user)) Router::redirect(Router::route("user.login"));

        $this->session_store_user_data($user);

        Router::redirect(Router::route("user.lk"));
    }

    public function auth() {
        $is_valid = true;
        foreach (["email", "password"] as $input) {
            if (empty($_POST[$input])) {
                $is_valid = false;
                Session::flash("errors.{$input}", "Это поле обязательно для заполнения");
            }
        }
        if (!$is_valid) Router::redirect(Router::back());

        $user = DB::query()
            ->from("user")
            ->where("email", "=", $_POST["email"])
            ->first();

        if (Hash::verifyPassword($_POST["password"], $user["password"])) {
            $this->session_store_user_data($user);
            Router::redirect(Router::route("user.lk"));
        } else {
            Session::flash("errors.email", "Неверный email или пароль");
            Router::redirect(Router::back());
        }
    }

    public function logout() {
        Session::clear();
        Router::redirect(Router::route("user.login"));
    }
}