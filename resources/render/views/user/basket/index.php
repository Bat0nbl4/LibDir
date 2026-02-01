<div class="row mb-3">
    <?php $total = 0 ?>
    <?php if (\core\session\Session::has("basket")): ?>
        <?php foreach (\core\session\Session::get("basket.books") as $key => $value): ?>
            <div class="col-6 col-sm-4 col-md-3 col-xl-2 d-flex flex-column gap-2">
                <a href="<?php echo \core\routing\Router::route("book.show", ["id" => $key]) ?>">
                    <img class="img-fluid cover" src="<?php echo $value["cover_url"] != null ? \core\helpers\Resource::get("img/Book/".$value["cover_url"]) : \core\helpers\Resource::get("img/system/base_img.jpg") ?>" alt="">
                </a>
                <?php \core\rendering\View::IncludeComponent("param", ["key" => "Цена", "value" => $value["price"]]); ?>
                <?php \core\rendering\View::IncludeComponent("param", ["key" => "Количество", "value" => $value["count"]]); ?>
                <?php \core\rendering\View::IncludeComponent("param", ["key" => "Итого", "value" => $mini_total = $value["price"] * $value["count"]]); $total += $mini_total; ?>
                <div class="d-flex flex-row align-items-center gap-2">
                    <a class="btn btn-outline-primary w-100" href="<?php echo \core\routing\Router::route("user.basket.add", ["id" => $key]) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                        </svg>
                    </a>
                    <a class="btn btn-outline-danger w-100" href="<?php echo \core\routing\Router::route("user.basket.remove", ["id" => $key]) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8"/>
                        </svg>
                    </a>
                    <a class="btn btn-outline-danger w-100" href="<?php echo \core\routing\Router::route("user.basket.remove", ["id" => $key, "count" => 0]) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="d-flex flex-column mb-3">
    <div class="d-flex flex-row align-items-end">
        <h3 class="p-0 m-0">Итого:&#160</h3>
        <div class="flex-fill min-w-50 border-dotted"></div>
        <h3 class="text-end p-0 m-0"> <?php echo $total ?></h3>
    </div>
</div>
<a href="<?php echo \core\routing\Router::route("user.basket.order") ?>" class="btn btn-primary">Заказать</a>