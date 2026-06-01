<?php

use core\routing\Router;

Router::get("/", [\controllers\main\MainController::class, "index"], "index");
Router::get("/about", [\controllers\main\MainController::class, "about"], "about");
Router::get("/contacts", [\controllers\main\MainController::class, "contacts"], "contacts");
Router::get("/residents", [\controllers\main\MainController::class, "residents"], "residents");

Router::group("/user", function () {
    Router::group("", function () {
        Router::get("/logout", [\controllers\user\UserActionController::class, "logout"], "user.logout");
        Router::get("/lk", [\controllers\user\UserController::class, "lk"], "user.lk");
    }, [\middleware\IsAuthMiddleware::class]);

    Router::group("", function () {
        Router::get("/registration", [\controllers\user\UserController::class, "registration"], "user.registration");
        Router::post("/store", [\controllers\user\UserActionController::class, "store"], "user.store");
        Router::get("/login", [\controllers\user\UserController::class, "login"], "user.login");
        Router::post("/auth", [\controllers\user\UserActionController::class, "auth"], "user.auth");
    }, [\middleware\IsNotAuthMiddleware::class]);
});

Router::group("/event", function () {
    Router::get("/list", [\controllers\user\EventController::class, "list"], "event.list");
    Router::get("/show", [\controllers\user\EventController::class, "show"], "event.show");
    Router::group("", function () {
        Router::post("/signup", [\controllers\user\EventActionController::class, "signup"], "event.signup");
    }, [\middleware\IsAuthMiddleware::class]);
});

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