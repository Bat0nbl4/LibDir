<?php

use core\routing\Router;

Router::get("/", [\controllers\main\MainController::class, "index"], "index");

/* --- EXAMPLES ---
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
*/