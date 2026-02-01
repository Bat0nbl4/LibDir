<?php

use core\routing\Router;

Router::get("/", [\controllers\main\MainController::class, "index"], "index");

Router::group("/user", function () {
    Router::group("", function () {
        Router::get("/logout", [\controllers\user\UserActionController::class, "logout"], "logout");
        Router::get("/lk", [\controllers\user\UserController::class, "lk"], "lk");

        Router::group("/basket", function () {
            Router::get("/index", [\controllers\basket\BasketController::class, "index"], "user.basket");
            Router::get("/add", [\controllers\basket\BasketActionController::class, "add"], "user.basket.add");
            Router::get("/remove", [\controllers\basket\BasketActionController::class, "remove"], "user.basket.remove");
            Router::get("/order", [\controllers\basket\BasketActionController::class, "order"], "user.basket.order");
        });
    }, [\middleware\IsAuthMiddleware::class]);

    Router::group("", function () {
        Router::get("/reg", [\controllers\user\UserController::class, "reg"], "reg");
        Router::post("/reg_action", [\controllers\user\UserActionController::class, "reg"], "reg_action");
        Router::get("/login", [\controllers\user\UserController::class, "login"], "login");
        Router::post("/login_action", [\controllers\user\UserActionController::class, "login"], "login_action");
    }, [\middleware\IsNotAuthMiddleware::class]);
});

Router::group("/book", function () {
    Router::group("", function () {
        Router::post("/store_review", [\controllers\book\BookActionController::class, "store_review"], "store_review");
        Router::get("/reserve", [\controllers\book\BookActionController::class, "reserve"], "reserve_book");
        Router::get("/chanel_reserve", [\controllers\book\BookActionController::class, "chanel_reserve"], "chanel_reserve_book");
    }, [\middleware\IsAuthMiddleware::class]);
    Router::get("/show", [\controllers\book\BookController::class, "show"], "book.show");
    Router::post("/search", [\controllers\book\BookController::class, "search"], "book.search");
});

Router::group("/admin", function () {
    Router::group("/book", function () {
        Router::get("/list", [\controllers\admin\book\BookController::class, "list"], "admin.book.list");
        Router::get("/edit", [\controllers\admin\book\BookController::class, "edit"], "admin.book.edit");
        Router::post("/put", [\controllers\admin\book\BookActionController::class, "put"], "admin.book.put");
        Router::get("/create", [\controllers\admin\book\BookController::class, "create"], "admin.book.create");
        Router::post("/store", [\controllers\admin\book\BookActionController::class, "store"], "admin.book.store");
        Router::get("/delete", [\controllers\admin\book\BookActionController::class, "delete"], "admin.book.delete");
    });

    Router::group("/author", function () {
        Router::get("/list", [\controllers\admin\author\AuthorController::class, "list"], "admin.author.list");
        Router::get("/edit", [\controllers\admin\author\AuthorController::class, "edit"], "admin.author.edit");
        Router::post("/put", [\controllers\admin\author\AuthorActionController::class, "put"], "admin.author.put");
        Router::get("/create", [\controllers\admin\author\AuthorController::class, "create"], "admin.author.create");
        Router::post("/store", [\controllers\admin\author\AuthorActionController::class, "store"], "admin.author.store");
        Router::get("/delete", [\controllers\admin\author\AuthorActionController::class, "delete"], "admin.author.delete");
    });

    Router::group("/batch", function () {
        Router::get("/list", [\controllers\admin\batch\BatchController::class, "list"], "admin.batch.list");
        Router::get("/edit", [\controllers\admin\batch\BatchController::class, "edit"], "admin.batch.edit");
        Router::post("/put", [\controllers\admin\batch\BatchActionController::class, "put"], "admin.batch.put");
        Router::get("/create", [\controllers\admin\batch\BatchController::class, "create"], "admin.batch.create");
        Router::post("/store", [\controllers\admin\batch\BatchActionController::class, "store"], "admin.batch.store");
        Router::get("/delete", [\controllers\admin\batch\BatchActionController::class, "delete"], "admin.batch.delete");
    });

    Router::group("/genre", function () {
        Router::get("/list", [\controllers\admin\genre\GenreController::class, "list"], "admin.genre.list");
        Router::get("/edit", [\controllers\admin\genre\GenreController::class, "edit"], "admin.genre.edit");
        Router::post("/put", [\controllers\admin\genre\GenreActionController::class, "put"], "admin.genre.put");
        Router::get("/create", [\controllers\admin\genre\GenreController::class, "create"], "admin.genre.create");
        Router::post("/store", [\controllers\admin\genre\GenreActionController::class, "store"], "admin.genre.store");
        Router::get("/delete", [\controllers\admin\genre\GenreActionController::class, "delete"], "admin.genre.delete");
    });

    Router::group("/publisher", function () {
        Router::get("/list", [\controllers\admin\publisher\PublisherController::class, "list"], "admin.publisher.list");
        Router::get("/edit", [\controllers\admin\publisher\PublisherController::class, "edit"], "admin.publisher.edit");
        Router::post("/put", [\controllers\admin\publisher\PublisherActionController::class, "put"], "admin.publisher.put");
        Router::get("/create", [\controllers\admin\publisher\PublisherController::class, "create"], "admin.publisher.create");
        Router::post("/store", [\controllers\admin\publisher\PublisherActionController::class, "store"], "admin.publisher.store");
        Router::get("/delete", [\controllers\admin\publisher\PublisherActionController::class, "delete"], "admin.publisher.delete");
    });

    Router::group("/order", function () {
        Router::get("/list", [\controllers\admin\order\OrderController::class, "list"], "admin.order.list");
        Router::get("/edit", [\controllers\admin\order\OrderController::class, "edit"], "admin.order.edit");
        Router::post("/put", [\controllers\admin\order\OrderActionController::class, "put"], "admin.order.put");
        Router::get("/delete", [\controllers\admin\order\OrderActionController::class, "delete"], "admin.order.delete");
    });
}, [\middleware\IsAdminMiddleware::class]);