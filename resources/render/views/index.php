<?php \core\rendering\View::title(BASE_PAGE_NAME."Главная"); ?>

<div class="container my-5 py-5">
    <h1 class="text-center text-main">Твоя&nbsp;территория развития. Твой&nbsp;КДМ.</h1>
    <hr>
    <p class="text-center">Твоё будущее начинается здесь!</p>
    <div class="d-flex justify-content-center">
        <?php if (\core\session\Session::has("user")): ?>
            <a class="btn btn-main" href="<?php echo \core\routing\Router::route("user.lk") ?>">Мой кабинет</a>
        <?php else: ?>
            <a class="btn btn-main" href="<?php echo \core\routing\Router::route("user.registration") ?>">Стать участиником!</a>
        <?php endif; ?>
    </div>
</div>

<div class="bg-white">
    <div class="container py-5">
        <h2 class="text-center text-main mb-4">Наши мероприятия</h2>
        <div class="row">
            <?php foreach ($events as $event): ?>
                <div class="col-md-12 col-lg-6 p-2">
                    <div class="card p-0 rounded-4 h-100">
                        <img class="img-fluid rounded-top-4" src="<?php echo \core\helpers\Resource::get("img/storage/".$event["img"]) ?>" alt="">
                        <div class="p-3 pt-2">
                            <h3><?php echo $event["title"] ?></h3>
                            <p><?php echo $event["short_description"] ?></p>
                            <div class="d-flex flex-row align-items-end">
                                <a class="btn btn-outline-primary me-md-auto" href="<?php echo \core\routing\Router::route("event.show", ["id" => $event["id"]]) ?>">Подробнее</a>
                                <span class="text-secondary"><?php echo \core\helpers\Date::normal_date($event["end_date"]) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <h4 class="mt-3">Больше мероприятий от КДМ можно <a href="<?php echo \core\routing\Router::route("event.list") ?>">увидеть здесь</a>.</h4>
    </div>
</div>
