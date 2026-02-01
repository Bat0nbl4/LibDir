<?php

namespace controllers\user;

use controllers\Controller;
use core\data_base\DB;
use core\routing\Router;
use core\helpers\Array_r;
use core\security\Hash;
use core\session\Session;

class UserActionController extends Controller {
    public function reg() {
        Session::clear();
        $users = DB::query()->from("user")->get();

        if (empty($_POST["name"])) {
            Session::flash("input_errors.name", "Поле \"Имя\" обязательно для заполнения.");
        }

        if (empty($_POST["surname"])) {
            Session::flash("input_errors.surname", "Поле \"Фамилия\" обязательно для заполнения.");
        }

        if (Array_r::has($_POST["email"], $users, depth: 2)) {
            Session::flash("input_errors.email", "Этот адрес почты уже кем то занят.");
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            Session::flash("input_errors.email", "Некоректный адресс почты.");
        }

        if (!empty($_POST["phone"]) and Array_r::has($_POST["phone"], $users, depth: 2)) {
            Session::flash("input_errors.phone", "Этот номер телефона уже кем то занят.");
        }

        if (empty($_POST["birthday"])) {
            Session::flash("input_errors.birthday", "Поле \"Дата рождения\" обязательно для заполнения.");
        } elseif (!strtotime($_POST["birthday"])) {
            Session::flash("input_errors.birthday", "Некоректная дата рождения.");
        }

        if (empty($_POST["password"])) {
            Session::flash("input_errors.password", "Поле \"Пароль\" обязательно для заполнения.");
        } elseif (strlen($_POST["password"]) < 8) {
            Session::flash("input_errors.password", "Минимальная длина пароля 8 символов.");
        }

        if ($_POST["password"] != $_POST["password_confirmation"]) {
            Session::flash("input_errors.password_confirmation", "Пароли не совпадают.");
        }

        if (Session::hasFlash("input_errors")) {
            Session::flash("old_input", $_POST);
            Session::removeFlash("old_input.password");
            Session::removeFlash("old_input.password_confirmation");
            Router::redirect(Router::route("reg"));
            return;
        }

        $user_id = DB::query()
            ->from("user")
            ->set([
                "name" => $_POST["name"],
                "surname" => $_POST["surname"],
                "patronymic" => $_POST["patronymic"],
                "phone" => $_POST["phone"],
                "email" => $_POST["email"],
                "birthdate" => $_POST["birthday"],
                "password" => Hash::hashPassword($_POST["password"])
            ])->insert();

        $user = DB::query()->from("user")->where("id", "=", $user_id)->first();

        Session::clear();
        Session::set("user", $user);
        Session::remove("user.password");

        Router::redirect(Router::route("index"));
    }

    public function login() {

        $user = DB::query()
            ->from("user")
            ->where("email", "=", $_POST["login"])
            ->orWhere("phone", "=", $_POST["login"])
            ->first();

        if (!$user) {
            Session::flash("input_errors.password", "Неверный логин или пароль.");
            Router::redirect(Router::route("login"));
            return;
        }

        if (!Hash::verifyPassword($_POST["password"], $user["password"])) {
            Session::flash("input_errors.password", "Неверный логин или пароль.");
            Router::redirect(Router::route("login"));
            return;
        }

        $role = DB::query()
            ->from("role")
            ->where("id", "=", $user["role_id"])
            ->first();

        Session::clear();
        Session::set("user", $user);
        Session::set("user.role.name", $role["name"]);
        Session::set("user.role.sys_name", $role["sys_name"]);
        Session::remove("user.password");

        Router::redirect(Router::route("index"));
    }

    public function logout() {
        Session::clear();
        Router::redirect(Router::route("login"));
    }
}

/*
<?php

namespace controllers\user;

use controllers\controller;
use core\rendering\View;
use core\data_base\DB;
use Hash;
use core\session\Session;
use core\routing\Router;
use core\helpers\Array_r;

class UserController extends controller
{
    public function auth() {
        View::render("user/authorization");
    }


    //авторизация
    public function auth_avto() {

        // Авторизация
        $user = DB::query()
            ->from("user")
            ->where("email", "=", $_POST["email"])
            ->first();

        if ($user) {
            if (Hash::verifyPassword($_POST["password"], $user["password"])) {
                Session::set("user", $user);
                Router::redirect(Router::route("index"));
                return;
            }
        }

        Session::flash("auth_error", "Неверная почта или пароль");
        Router::redirect(Router::route("auth"));
    }

    public function logout() {
        Session::clear();
        Router::redirect(Router::route("auth"));
    }

    public function reg() {
        View::render("user/registration");
    }

    //регистрация
    public function reg_avto() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Router::redirect(Router::route("auth"));
            exit;
        }

        $users = DB::query()->from("user")->get();

        if (empty($_POST['name'])) {
            Session::flash("input_errors", ["name" => 'Имя обязательно для заполнения']);
        }

        if (empty($_POST['email'])) {
            Session::flash("input_errors", ["email" => 'Email обязателен для заполнения']);
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            Session::flash("input_errors", ["email" => 'Некорректный формат email']);
        } elseif (Array_r::has($_POST['email'], $users, depth: 2)) {
            Session::flash("input_errors", ["email" => 'Этот email уже используется']);
        }

        if (empty($_POST['phone'])) {
            Session::flash("input_errors", ["phone" => 'Телефон обязателен для заполнения']);
        } elseif (Array_r::has($_POST['phone'], $users, 2)) {
            Session::flash("input_errors", ["phone" => 'Этот номер телефона уже используется']);
        }

        if (empty($_POST['password'])) {
            Session::flash("input_errors", ["password" => 'Пароль обязателен для заполнения']);
        } elseif (strlen($_POST['password']) < 6) {
            Session::flash("input_errors", ["password" => 'Пароль должен содержать минимум 6 символов']);
        }

        if (Session::hasFlash("input_errors")) {
            Router::redirect(Router::route("reg"));
            exit;
        }

        // Хешируем пароль
        $hashedPassword = Hash::hashPassword($_POST['password']);

        // Добавляем пользователя
        DB::query()
        ->from("user")
        ->set([
            "name" => $_POST['name'],
            "email"=> $_POST['email'],
            "phone"=> $_POST['phone'],
            "creation_date" => date('Y-m-d'),
            "password" => $hashedPassword
        ])
        ->insert();

        // Авторизация
        $user = DB::query()->from("user")->where("email", "=", $_POST["email"])->first();
        Session::set("user", $user);

        Router::redirect(Router::route("auth"));
    }
}

 */
