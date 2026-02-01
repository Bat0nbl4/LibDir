<?php \core\rendering\View::title("book"); ?>
<script src="<?php echo \core\helpers\Resource::get("js/reviews.js") ?>"></script>

<div class="row">
    <h1 class="text-primary col-12 text-center"><?php echo $book["title"] ?></h1>
    <div class="col-12 col-md-4 col-lg-3">
        <img class="img-fluid w-100 cover" src="<?php echo $book["cover_url"] != null ? \core\helpers\Resource::get("img/Book/".$book["cover_url"]) : \core\helpers\Resource::get("img/system/base_img.jpg") ?>" alt="">
    </div>
    <div class="col-12 col-md-8 col-lg-9 d-flex flex-column gap-3 px-md-4 fs-5 my-3 my-md-0">
        <?php \core\rendering\View::IncludeComponent("param", ["key" => "Количество страниц", "value" => $book["pages_count"]]); ?>
        <?php \core\rendering\View::IncludeComponent("param", ["key" => "Издательство", "value" => $book["publisher"] != null ? $book["publisher"]["name"] : null]); ?>
        <?php \core\rendering\View::IncludeComponent("param", ["key" => "Дата издания", "value" => $book["batch"] != null ? \core\helpers\Date::normal_date($book["batch"]["date"]) : null]); ?>
        <?php \core\rendering\View::IncludeComponent("param", ["key" => "Серия", "value" => $book["batch"] != null ? $book["batch"]["name"] : null]); ?>
        <?php \core\rendering\View::IncludeComponent("param", ["key" => "Автор", "value" => $book["author"] ? $book["author"]["name"]." ".$book["author"]["patronymic"]." ".$book["author"]["surname"] : null]); ?>
        <?php \core\rendering\View::IncludeComponent("param", ["key" => "Жанр", "value" => $book["genre"]]); ?>
        <?php \core\rendering\View::IncludeComponent("param", ["key" => "В наличии", "value" => $book["count"]]); ?>
        <?php \core\rendering\View::IncludeComponent("param", ["key" => "Цена", "value" => $book["price"] != 0 ? $book["price"] : "Не указанна"]); ?>
        <div class="d-flex flex-row gap-2">
            <a class="btn btn-outline-primary" href="<?php echo \core\routing\Router::route("user.basket.add", ["id" => $book["id"]]) ?>">Добавить в корзину</a>
            <?php if (\core\session\Session::get("user.role.sys_name") == "admin"): ?>
                <a class="btn btn-outline-success" href="<?php echo \core\routing\Router::route("admin.book.edit", ["id" => $book["id"]]) ?>">Редактировать</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="mb-3 fs-5">
    <?php if ($book["description"] != null): ?>
        <h2>О книге</h2>
        <p class="text-justify"><?php echo $book["description"] ?></p>
    <?php endif; ?>
    <?php if (!empty($book["author"]["about"])): ?>
        <h2>Об авторе.</h2>
        <p class="text-justify"><?php echo $book["author"]["about"]?></p>
    <?php endif; ?>
</div>

<div class="row">
    <?php if (isset($feedback) and $feedback != null): ?>
        <h2>Отзывы</h2>
        <div class="d-flex flex-row align-items-center gap-3 mb-3">
            <h2 class="m-0"><?php echo isset($feedback_avg) ? round($feedback_avg, 1) : 0 ?></h2>
            <div class="d-flex flex-row gap-1">
                <?php
                    if (isset($feedback_avg)) {
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= round($feedback_avg, 0)) {
                                echo "<img class='decor_big_star' src='".\core\helpers\Resource::get("img/system/star.svg")."'>";
                            } else {
                                echo "<img class='decor_big_star' src='".\core\helpers\Resource::get("img/system/gray_star.svg")."'>";
                            }
                        }
                    }
                ?>
            </div>
            <span>Оценок: <?php echo $estimations_count ?? 0 ?></span>
        </div>
        <div class="d-flex flex-column gap-2">
            <div class="d-flex flex-row gap-3 align-items-center">
                <div>
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                </div>
                <div class="progress_bar flex-fill bg-light rounded-2">
                    <div class="progress bg-primary" style="--progress: <?php echo isset($feedback) ? $feedback["estimation_5"] / $estimations_count * 100 : 0 ?>%"></div>
                </div>
                <span class="short_str min-w-50"><?php echo $feedback["estimation_5"] ?? 0 ?></span>
            </div>
            <div class="d-flex flex-row gap-3 align-items-center">
                <div>
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>">
                </div>
                <div class="progress_bar flex-fill bg-light rounded-2">
                    <div class="progress bg-primary" style="--progress: <?php echo isset($feedback) ? $feedback["estimation_4"] / $estimations_count * 100 : 0 ?>%"></div>
                </div>
                <span class="short_str min-w-50"><?php echo $feedback["estimation_4"] ?? 0 ?></span>
            </div>
            <div class="d-flex flex-row gap-3 align-items-center">
                <div>
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>">
                </div>
                <div class="progress_bar flex-fill bg-light rounded-2">
                    <div class="progress bg-primary" style="--progress: <?php echo isset($feedback) ? $feedback["estimation_3"] / $estimations_count * 100 : 0 ?>%"></div>
                </div>
                <span class="short_str min-w-50"><?php echo $feedback["estimation_3"] ?? 0 ?></span>
            </div>
            <div class="d-flex flex-row gap-3 align-items-center">
                <div>
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>">
                </div>
                <div class="progress_bar flex-fill bg-light rounded-2">
                    <div class="progress bg-primary" style="--progress: <?php echo isset($feedback) ? $feedback["estimation_2"] / $estimations_count * 100 : 0 ?>%"></div>
                </div>
                <span class="short_str min-w-50"><?php echo $feedback["estimation_2"] ?? 0 ?></span>
            </div>
            <div class="d-flex flex-row gap-3 align-items-center">
                <div>
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>">
                    <img class="decor_star" src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>">
                </div>
                <div class="progress_bar flex-fill bg-light rounded-2">
                    <div class="progress bg-primary" style="--progress: <?php echo isset($feedback) ? $feedback["estimation_1"] / $estimations_count * 100 : 0 ?>%"></div>
                </div>
                <span class="short_str min-w-50"><?php echo $feedback["estimation_1"] ?? 0 ?></span>
            </div>
        </div>
    <?php else: ?>
        <div class="d-flex flex-row justify-content-center align-items-center gap-5">
            <img class="decor_big_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
            <div class="flex column">
                <h2 class="text-center">Нет отзывов!</h2>
                <?php if (\core\session\Session::has("user")): ?>
                    <span class="text-center">Будте первым! Напишите свой отзыв!</span>
                <?php else: ?>
                    <span class="text-center">Что-бы оставить отзыв, вам необходимо <a href="<?php echo \core\routing\Router::route("login") ?>">авторизироваться</a>.</span>
                <?php endif; ?>
            </div>
            <img class="decor_big_star" src="<?php echo \core\helpers\Resource::get("img/system/star.svg") ?>">
        </div>
    <?php endif; ?>
    <?php if (!$isReviewed): ?>
        <?php if (\core\session\Session::has("user")): ?>
            <form method="POST" action="<?php echo \core\routing\Router::route("store_review") ?>">
                <input type="number" min="1" max="5" name="estimation" id="estimation" hidden>
                <input type="number" name="id" hidden value="<?php echo $book["id"] ?>">
                <div class="d-flex flex-column align-items-center">
                    <span class="fs-5 form-label">Ваша оценка</span>
                    <div class="flex flex-row">
                        <button type="button" class="star" data-value="1"><img class="img-fluid" src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>"></button><button type="button" class="star" data-value="2"><img class="img-fluid" src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>"></button><button type="button" class="star" data-value="3"><img class="img-fluid" src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>"></button><button type="button" class="star" data-value="4"><img class="img-fluid" src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>"></button><button type="button" class="star" data-value="5"><img class="img-fluid"v src="<?php echo \core\helpers\Resource::get("img/system/gray_star.svg") ?>"></button>
                    </div>
                </div>
                <label class="fs-5 form-label" for="comment">Коментарий к отзыву <span class="text-muted">(Не обязательно)</span></label>
                <textarea class="form-control mb-2" name="comment" id="comment" rows="10"></textarea>
                <button class="btn btn-primary">Отправить</button>
            </form>
        <?php else: ?>
            <a class="btn btn-outline-primary my-3" href="<?php echo \core\routing\Router::route("login") ?>">Авторизироваться</a>
        <?php endif; ?>
    <?php endif; ?>
    <div class="d-flex flex-column gap-3 mt-3">
        <?php foreach ($reviews as $review): ?>
            <div class="shadow-sm p-2 rounded-2">
                <div class="d-flex flex-row align-items-center">
                    <h4 class="col-auto"><?php echo $review["surname"] ?>&#160<?php echo mb_substr($review["name"], 0, 1, 'UTF-8') ?>.&#160<?php echo $review["patronymic"] ? mb_substr($review["patronymic"], 0, 1, 'UTF-8')."." : "" ?></h4>
                    <div class="col-auto ms-auto">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $review["estimation"]) {
                                echo "<img class='decor_star' src='".\core\helpers\Resource::get("img/system/star.svg")."'>";
                            } else {
                                echo "<img class='decor_star' src='".\core\helpers\Resource::get("img/system/gray_star.svg")."'>";
                            }
                        }
                        ?>
                    </div>
                </div>
                <p><?php echo $review["comment"] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>