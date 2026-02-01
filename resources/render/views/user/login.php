<div class="row justify-content-center">
    <form class="col-auto col-md-4 shadow rounded-3 p-4 pb-3 mt-5" method="POST" action="<?php echo \core\routing\Router::route("login_action") ?>">
        <div class="mb-3">
            <label class="form-label" for="login">E-mail/номер телефона <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="login" name="login" value="<?php echo \core\session\Session::getFlash("old_input.login") ?? ""; ?>" required>
            <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.login") ?? ""; ?></span>
        </div>
        <div  class="mb-3">
            <label class="form-label" for="password">Пароль <span class="text-danger">*</span></label>
            <input class="form-control" type="password" id="password" name="password" required>
            <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.password") ?? ""; ?></span>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary" type="submit">Войти</button>
        </div>
        <br>
        <span class="text-center d-block w-100">
            <a href="<?php echo \core\routing\Router::route("reg"); ?>">Регистрация</a>
        </span>
    </form>
</div>