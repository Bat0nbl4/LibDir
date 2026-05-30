<?php \core\rendering\View::title(BASE_PAGE_NAME."Главная"); ?>

<div class="container my-5 py-5">
    <h1 class="text-center text-main">Твоя&nbsp;территория развития. Твой&nbsp;КДМ.</h1>
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
            <?php for ($i = 0; $i < 4; $i++): ?>
                <div class="col-md-12 col-lg-6 p-2">
                    <div class="card p-0 rounded-4 h-100">
                        <img class="img-fluid rounded-top-4" src="<?php echo \core\helpers\Resource::get("img/storage/ATR.jpg") ?>" alt="">
                        <div class="p-3 pt-2">
                            <h3>«Алтай. Территория развития – 2026»</h3>
                            <p>С 22 по 25 мая на базе санатория «Сосновый бор» (с. Зудилово, Первомайский район) состоялся 18-й региональный форум «Алтай. Территория развития».</p>
                            <p>Мероприятие объединило более 350 представителей активной молодёжи Алтайского края в возрасте от 14 до 35 лет: волонтёров, лидеров студенческого самоуправления, педагогов, государственных служащих, активистов «Движения Первых», бойцов студенческих отрядов, медийных специалистов и работающую молодёжь.</p>
                            <div class="d-flex flex-row align-items-end">
                                <a class="btn btn-outline-primary me-md-auto" href="<?php echo \core\routing\Router::route("index") ?>">Подробнее</a>
                                <span class="text-secondary">25.05.2026</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <h4 class="mt-3">Больше мероприятий от КДМ можно <a href="<?php echo \core\routing\Router::route("event.list") ?>">увидеть здесь</a>.</h4>
    </div>
</div>
