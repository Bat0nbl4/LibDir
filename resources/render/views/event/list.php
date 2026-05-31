<?php \core\rendering\View::title(BASE_PAGE_NAME."Афиша"); ?>

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
        <div class="d-flex justify-content-center align-items-center gap-1 fs-4">
            <a class="text-decoration-none <?php echo $current_page > 1 ? "text-primary" : "text-secondary" ?>" href="<?php echo $current_page > 1 ? \core\routing\Router::route("index", ["page" => 1]) : "" ?>">⋘</a>
            <a class="text-decoration-none <?php echo $current_page - 1 >= 1 ? "text-primary" : "text-secondary" ?>" href="<?php echo $current_page - 1 >= 1 ? \core\routing\Router::route("index", ["page" => $current_page - 1]) : "" ?>"><</a>
            <a class="text-decoration-none"><?php echo $current_page ?></a>
            <a class="text-decoration-none <?php echo $current_page + 1 <= $page_count ? "text-primary" : "text-secondary" ?>" href="<?php echo $current_page + 1 <= $page_count ? \core\routing\Router::route("index", ["page" => $current_page + 1]) : ""?>">></a>
            <a class="text-decoration-none <?php echo $current_page < $page_count ? "text-primary" : "text-secondary" ?>" href="<?php echo $current_page < $page_count ? \core\routing\Router::route("index", ["page" => $page_count]) : "" ?>">⋙</a>
        </div>
    </div>
</div>
