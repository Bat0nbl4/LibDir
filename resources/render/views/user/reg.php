<form class="row shadow rounded-3 p-4 pb-3 mt-5 max-w-800 mx-auto" method="POST" action="<?php echo \core\routing\Router::route("reg_action") ?>">
    <p class="col-12 px-1">
        Поля, помеченные символом "<b><span class="text-danger">*</span></b>" — обязательны для заполнения!
    </p>
    <div></div>
    <div class="col-12 col-md-4 px-1 mb-md-2">
        <label class="form-label" for="name">Имя <span class="text-danger">*</span></label>
        <input class="form-control" type="text" id="name" name="name" value="<?php echo \core\session\Session::getFlash("old_input.name") ?? ""; ?>" required>
        <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.name") ?? ""; ?></span>
    </div>
    <div class="col-12 col-md-4 px-1  mb-md-2">
        <label class="form-label" for="surname">Фамилия <span class="text-danger">*</span></label>
        <input class="form-control" type="text" id="surname" name="surname" value="<?php echo \core\session\Session::getFlash("old_input.surname") ?? ""; ?>" required>
        <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.surname") ?? ""; ?></span>
    </div>
    <div class="col-12 col-md-4 px-1 mb-md-2 mb-4">
        <label class="form-label" for="patronymic">Отчество</label>
        <input class="form-control" type="text" id="patronymic" name="patronymic" value="<?php echo \core\session\Session::getFlash("old_input.patronymic") ?? ""; ?>">
        <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.patronymic") ?? ""; ?></span>
    </div>

    <div class="col-12 col-md-7 px-1 mb-md-2">
        <label class="form-label" for="email">E-mail <span class="text-danger">*</span></label>
        <input class="form-control" type="email" id="email" name="email" value="<?php echo \core\session\Session::getFlash("old_input.email") ?? ""; ?>" required>
        <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.email") ?? ""; ?></span>
    </div>
    <div class="col-12 col-md-5 px-1 mb-md-2 mb-4">
        <label class="form-label" for="phone">Номер телефона <span class="text-danger">*</span></label>
        <input class="form-control" type="tel" id="phone" name="phone" value="<?php echo \core\session\Session::getFlash("old_input.phone") ?? ""; ?>" required>
        <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.phone") ?? ""; ?></span>
    </div>

    <div class="col-12 px-1 mb-4">
        <label class="form-label" for="birthday">Дата рождения <span class="text-danger">*</span></label>
        <input class="form-control" type="date" id="birthday" name="birthday" value="<?php echo \core\session\Session::getFlash("old_input.birthday") ?? ""; ?>" required>
        <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.birthday") ?? ""; ?></span>
    </div>

    <div class="col-12 col-md-6 px-1 mb-md-2">
        <label class="form-label" for="password">Пароль <span class="text-danger">*</span></label>
        <input class="form-control" type="password" id="password" name="password" required>
        <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.password") ?? ""; ?></span>
    </div>
    <div class="col-12 col-md-6 px-1 mb-md-2 mb-4">
        <label class="form-label" for="password_confirmation">Повторите пароль <span class="text-danger">*</span></label>
        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
        <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.password_confirmation") ?? ""; ?></span>
    </div>

    <div class="col-12 px-1 mb-4 d-flex justify-content-end">
        <button class="btn btn-primary">Регистрация</button>
    </div>
    <span class="text-center">
        <a href="<?php echo \core\routing\Router::route("login") ?>">Войти</a>
    </span>
</form>