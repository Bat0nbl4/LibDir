<div class="container my-5 py-5">
    <div class="row justify-content-center">
        <form method="post" action="<?php echo \core\routing\Router::route("user.auth") ?>" class="col-12 card d-flex flex-column gap-3 p-3 rounded-4" style="max-width: 500px">
            <h2 class="text-center text-main">Авторизация</h2>
            <div> <?php $input = "email"; ?>
                <label class="form-label" for="<?php echo $input; ?>">E-mail</label>
                <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="email" placeholder="example@mail.ru" value="<?php echo \core\session\Session::getFlash("old.".$input) ?>" required>
                <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
            </div>
            <div> <?php $input = "password"; ?>
                <label class="form-label" for="<?php echo $input; ?>">Пароль</label>
                <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="password" placeholder="********" required>
                <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
            </div>
            <div>
                <button type="submit" class="btn btn-primary px-3">Войти</button>
            </div>
            <p class="text-center">Вы впервые в КДМ? <a href="<?php echo \core\routing\Router::route("user.registration") ?>">Зарегестрируйтесь</a></p>
        </form>
    </div>
</div>