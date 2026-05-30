<script src="<?php echo \core\helpers\Resource::get("js/phone-input.js") ?>"></script>
<div class="container my-5 py-5">
    <div class="row justify-content-center">
        <form method="post" action="<?php echo \core\routing\Router::route("user.store") ?>" class="col-12 card d-flex flex-column gap-3 p-3 rounded-4" style="max-width: 700px">
            <h2 class="text-center text-main">Регистрация</h2>
            <p>Поля, помеченные символом "<span class="text-danger">*</span>" — обязательны для заполнения!</p>

            <div class="d-flex flex-column flex-md-row align-items-md-start gap-2">
                <div class="flex-fill"> <?php $input = "surname"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">Фамилия <span class="text-danger">*</span></label>
                    <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="text" placeholder="Иванов" value="<?php echo \core\session\Session::getFlash("old.".$input) ?>" required>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
                <div class="flex-fill"> <?php $input = "name"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">Имя <span class="text-danger">*</span></label>
                    <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="text" placeholder="Иван" value="<?php echo \core\session\Session::getFlash("old.".$input) ?>" required>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
                <div class="flex-fill"> <?php $input = "patronymic"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">Отчество</label>
                    <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="text" placeholder="Иванович" value="<?php echo \core\session\Session::getFlash("old.".$input) ?>">
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
            </div>

            <div class="d-flex flex-column flex-md-row align-items-md-start gap-2">
                <div> <?php $input = "gender"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">Пол <span class="text-danger">*</span></label>
                    <select class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" required>
                        <option value="М" <?php echo \core\session\Session::getFlash("old." . $input) == "М" ? "selected" : "" ?>>М</option>
                        <option value="Ж" <?php echo \core\session\Session::getFlash("old." . $input) == "Ж" ? "selected" : "" ?>>Ж</option>
                    </select>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
                <div class="flex-fill"> <?php $input = "birthdate"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">Дата рождения <span class="text-danger">*</span></label>
                    <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="date" value="<?php echo \core\session\Session::getFlash("old.".$input) ?>"  required>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
            </div>

            <hr class="m-0">

            <div class="d-flex flex-column flex-sm-row align-items-sm-start gap-2">
                <div class="w-100"> <?php $input = "email"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">E-mail <span class="text-danger">*</span></label>
                    <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="email" value="<?php echo \core\session\Session::getFlash("old.".$input) ?>" placeholder="example@mail.ru" required>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
                <div class="w-100"> <?php $input = "phone"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">Номер телефона <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">+7</span>
                        <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="tel" value="<?php echo \core\session\Session::getFlash("old.".$input) ?>" placeholder="(XXX) XXX-XXXX" required>
                    </div>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row align-items-sm-start gap-2">
                <div class="flex-fill"> <?php $input = "password"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">Пароль <span class="text-danger">*</span></label>
                    <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="password" placeholder="********" minlength="8" required>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
                <div class="flex-fill"> <?php $input = "password_confirmation"; ?>
                    <label class="form-label" for="<?php echo $input; ?>">Повторите пароль <span class="text-danger">*</span></label>
                    <input class="form-control" id="<?php echo $input; ?>" name="<?php echo $input; ?>" type="password" placeholder="********" minlength="8" required>
                    <span class="small text-danger"><?php echo \core\session\Session::getFlash("error.".$input) ?></span>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary px-3">Регистрация</button>
            </div>
            <p class="text-center">У вас уже есть аккаунт? <a href="<?php echo \core\routing\Router::route("user.login") ?>">Войти</a></p>
        </form>
    </div>
</div>