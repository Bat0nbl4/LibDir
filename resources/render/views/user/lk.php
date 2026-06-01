<?php \core\rendering\View::title(BASE_PAGE_NAME."Мой кабинет"); ?>
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-12 card d-flex flex-column gap-3 p-3 rounded-4" style="max-width: 700px">
            <h2 class="text-center text-main">Мои данные</h2>

            <div class="d-flex flex-column flex-md-row align-items-md-start gap-2">
                <div class="flex-fill"> <?php $input = "surname"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">Фамилия</label>
                    <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="text" placeholder="Иванов" value="<?php echo \core\session\Session::get("user.{$input}") ?>" disabled>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
                <div class="flex-fill"> <?php $input = "name"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">Имя</label>
                    <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="text" placeholder="Иван" value="<?php echo \core\session\Session::get("user.{$input}") ?>" disabled>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
                <div class="flex-fill"> <?php $input = "patronymic"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">Отчество</label>
                    <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="text" placeholder="Иванович" value="<?php echo \core\session\Session::get("user.{$input}") ?>" disabled>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
            </div>

            <div class="d-flex flex-column flex-md-row align-items-md-start gap-2">
                <div> <?php $input = "gender"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">Пол</label>
                    <select class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" disabled>
                        <option value="М" <?php echo \core\session\Session::get("user." . $input) == "М" ? "selected" : "" ?>>М</option>
                        <option value="Ж" <?php echo \core\session\Session::get("user." . $input) == "Ж" ? "selected" : "" ?>>Ж</option>
                    </select>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
                <div class="flex-fill"> <?php $input = "birthdate"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">Дата рождения</label>
                    <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="date" value="<?php echo \core\session\Session::get("user.{$input}") ?>"  disabled>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
            </div>

            <hr class="m-0">

            <div class="d-flex flex-column flex-sm-row align-items-sm-start gap-2">
                <div class="w-100"> <?php $input = "email"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">E-mail</label>
                    <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="text" value="<?php echo \core\session\Session::get("user.{$input}") ?>" disabled>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
                <div class="w-100"> <?php $input = "phone"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">Номер телефона</label>
                    <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="text" value="<?php echo \core\session\Session::get("user.{$input}") ?>" disabled>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
            </div>
            <div class="d-flex flex-row">
                <a href="<?php echo \core\routing\Router::route("user.logout") ?>" class="btn btn-outline-danger ms-auto">Выйти</a>
            </div>
        </div>
    </div>
</div>

<div class="bg-white">
    <div class="container py-5">
        <h2 class="text-center text-main mb-4">Мои записи</h2>
        <div class="row">
            <?php foreach ($events as $event): ?>
                <div class="col-md-12 col-lg-6 p-2">
                    <div class="card p-0 rounded-4 h-100">
                        <img class="img-fluid rounded-top-4" src="<?php echo \core\helpers\Resource::get("img/storage/".$event["img"]) ?>" alt="">
                        <div class="p-3 pt-2">
                            <h3><?php echo $event["title"] ?></h3>
                            <p><?php echo $event["short_description"] ?></p>
                            <div class="d-flex flex-row align-items-center gap-3">
                                <a class="btn btn-outline-primary" href="<?php echo \core\routing\Router::route("event.show", ["id" => $event["id"]]) ?>">Подробнее</a>
                                <span class="text-secondary ms-md-auto mt-auto"><?php echo \core\helpers\Date::normal_date($event["end_date"]) ?></span>
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
