<?php \core\rendering\View::title(BASE_PAGE_NAME."Мой кабинет"); ?>
<div class="container my-3">
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