<?php

namespace controllers\admin\book;

use controllers\Controller;
use core\data_base\DB;
use core\helpers\Resource;
use core\helpers\Str;
use core\routing\Router;
use core\session\Session;

class BookActionController extends Controller
{
    public function put(int $id) {
        $book = DB::query()
            ->from("book")
            ->where("id", "=", $id)
            ->first();

        if (!$book) {
            Session::flash("old_input", $_POST);
            Router::redirect(Router::back(Router::route("index")));
            return;
        }

        $valid = true;
        if (empty($_POST["title"])) {
            $valid = false;
            Session::flash("input_errors.title", "Поле \"Название\" обязательно для заполнения.");
        }
        if (empty($_POST["pages_count"])) {
            $valid = false;
            Session::flash("input_errors.pages_count", "Поле \"Кол-во страниц\" обязательно для заполнения.");
        }
        if (empty($_POST["count"])) {
            $valid = false;
            Session::flash("input_errors.count", "Поле \"В наличии\" обязательно для заполнения.");
        }
        if (!empty($_POST["price"]) and $_POST["price"] <= 0) {
            $valid = false;
            Session::flash("input_errors.price", "Цена не может быть отрицательной.");
        }

        if ($_FILES["cover"]) {
            if ($_FILES["cover"]["name"]) {
                if ($_FILES["cover"]["error"] !== UPLOAD_ERR_OK) {
                    Session::flash("input_errors.cover", "Ошибка при загрузке файла: ".$_FILES["cover"]["error"]);
                    $valid = false;
                } elseif (!in_array($_FILES["cover"]["type"], ["image/jpeg", "image/png", "image/webp"])) {
                    Session::flash("input_errors.cover", "Файл имеет неразрешённое расширение.");
                    $valid = false;
                } elseif ($_FILES["cover"]["size"] >= 4 * 1024 * 1024) {
                    Session::flash("input_errors.cover", "Размер файла не может быть больше 4 МБ.");
                    $valid = false;
                }
            }

            if ($_FILES["cover"]["name"] and $valid) {
                $fileName = Str::unique_random(8).".".pathinfo($_FILES["cover"]["name"], PATHINFO_EXTENSION);;
                if (!move_uploaded_file(
                    $_FILES['cover']['tmp_name'],
                    substr(Resource::get("img/book/").$fileName, 1)
                )) {
                    Session::flash("input_errors.cover", "Непредвиденная ошибка загрузки изображения.");
                    $valid = false;
                }
            }
        }

        if (!$valid) {
            Session::flash("old_input", $_POST);
            Router::redirect(Router::back(Router::route("index")));
            return;
        }

        $author = DB::query()->from("author")->where("id", "=", $_POST["author_id"])->first();
        $publisher = DB::query()->from("publisher")->where("id", "=", $_POST["publisher_id"])->first();
        $batch = DB::query()->from("batch")->where("id", "=", $_POST["batch_id"])->first();
        $genre = DB::query()->from("genre")->where("id", "=", $_POST["genre_id"])->first();
        $price = DB::query()->from("price")->where("book_id", "=", $id)->orderBy("id", "DESC")->first();


        $update = [
            "title" => $_POST["title"],
            "pages_count" => $_POST["pages_count"],
            "count" => $_POST["count"],
            "author_id" => $author["id"] ?? null,
            "publisher_id" => $publisher["id"] ?? null,
            "batch_id" => $batch["id"] ?? null,
            "genre_id" => $genre["id"] ?? null,
            "description" => $_POST["description"],
        ];

        if (!empty($fileName)) {
            $update["cover_url"] = $fileName;
            if (!unlink(substr(Resource::get("img/book/".$book["cover_url"]), 1))) {
                Session::flash("file_load_success", false);
            } else {
                Session::flash("file_load_success", true);
            }
        }

        DB::query()
            ->from("book")
            ->where("id", "=", $id)
            ->update($update);


        if ($_POST["price"] != $price["price"]) {
            DB::query()
                ->from("price")
                ->set([
                    "book_id" => $id,
                    "price" => $_POST["price"],
                    "created_at" => date("Y-m-d H:i:s")
                ])
                ->insert();
        }

        Router::redirect(Router::back());
    }

    public function store() {
        $valid = true;
        if (empty($_POST["title"])) {
            $valid = false;
            Session::flash("input_errors.title", "Поле \"Название\" обязательно для заполнения.");
        }
        if (empty($_POST["pages_count"])) {
            $valid = false;
            Session::flash("input_errors.pages_count", "Поле \"Кол-во страниц\" обязательно для заполнения.");
        }
        if (empty($_POST["count"])) {
            $valid = false;
            Session::flash("input_errors.count", "Поле \"В наличии\" обязательно для заполнения.");
        }
        if (!empty($_POST["price"]) and $_POST["price"] <= 0) {
            $valid = false;
            Session::flash("input_errors.price", "Цена не может быть отрицательной.");
        }

        if ($_FILES["cover"]) {
            if ($_FILES["cover"]["name"]) {
                if ($_FILES["cover"]["error"] !== UPLOAD_ERR_OK) {
                    Session::flash("input_errors.cover", "Ошибка при загрузке файла: ".$_FILES["cover"]["error"]);
                    $valid = false;
                } elseif (!in_array($_FILES["cover"]["type"], ["image/jpeg", "image/png", "image/webp"])) {
                    Session::flash("input_errors.cover", "Файл имеет неразрешённое расширение.");
                    $valid = false;
                } elseif ($_FILES["cover"]["size"] >= 4 * 1024 * 1024) {
                    Session::flash("input_errors.cover", "Размер файла не может быть больше 4 МБ.");
                    $valid = false;
                }
            }

            if ($_FILES["cover"]["name"] and $valid) {
                $fileName = Str::unique_random(8).".".pathinfo($_FILES["cover"]["name"], PATHINFO_EXTENSION);;
                if (!move_uploaded_file(
                    $_FILES['cover']['tmp_name'],
                    substr(Resource::get("img/book/").$fileName, 1)
                )) {
                    Session::flash("input_errors.cover", "Непредвиденная ошибка загрузки изображения.");
                    $valid = false;
                }
            }
        }

        if (!$valid) {
            Session::flash("old_input", $_POST);
            Router::redirect(Router::back(Router::route("index")));
            return;
        }

        $author = DB::query()->from("author")->where("id", "=", $_POST["author_id"])->first();
        $publisher = DB::query()->from("publisher")->where("id", "=", $_POST["publisher_id"])->first();
        $batch = DB::query()->from("batch")->where("id", "=", $_POST["batch_id"])->first();
        $genre = DB::query()->from("genre")->where("id", "=", $_POST["genre_id"])->first();
        $price = DB::query()->from("price")->where("book_id", "=", $id)->orderBy("id", "DESC")->first();


        $data = [
            "title" => $_POST["title"],
            "pages_count" => $_POST["pages_count"],
            "count" => $_POST["count"],
            "author_id" => $author["id"] ?? null,
            "publisher_id" => $publisher["id"] ?? null,
            "batch_id" => $batch["id"] ?? null,
            "genre_id" => $genre["id"] ?? null,
            "description" => $_POST["description"] ?? null,
        ];

        if (!empty($fileName)) {
            $data["cover_url"] = $fileName;
        }

        $book_id = DB::query()
            ->from("book")
            ->set($data)
            ->insert();

        if ($_POST["price"] != $price["price"]) {
            DB::query()
                ->from("price")
                ->set([
                    "book_id" => $book_id,
                    "price" => $_POST["price"],
                    "created_at" => date("Y-m-d H:i:s")
                ])
                ->insert();
        }

        Router::redirect(Router::route("book.show", ["id" => $book_id]));
    }

    public function set_price(int $book_id) {
        DB::query()
            ->from("price")
            ->set([
                "book_id" => $book_id,
                "price" => $_POST["price"],
                "created_at" => date("Y-m-d H:i:s")
            ])
            ->insert();
        Router::redirect(Router::route("book.show"));
    }

    public function delete(int $id) {
        DB::query()
            ->from("book")
            ->where("id", "=", $id)
            ->delete();

        Router::redirect(Router::route("admin.book.list"));
    }
}
