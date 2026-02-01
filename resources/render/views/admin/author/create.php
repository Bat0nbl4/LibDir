<form method="POST" action="<?php echo \core\routing\Router::route("admin.author.store") ?>" enctype="multipart/form-data">
    <p>
        Поля, помеченные символом "<b><span class="text-danger">*</span></b>" — обязательны для заполнения!
    </p>
    <div class="row mb-3">
        <div class="col-12 col-md-4 mb-3">
            <label class="form-label" for="surname">Фамилия<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="surname" name="surname" value="<?php echo \core\session\Session::getFlash("old_input.surname") ?? ""; ?>" required>
            <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.surname") ?? ""; ?></span>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <label class="form-label" for="name">Имя<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="name" name="name" value="<?php echo \core\session\Session::getFlash("old_input.name") ?? ""; ?>" required>
            <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.name") ?? ""; ?></span>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <label class="form-label" for="patronymic">Отчество</label>
            <input class="form-control" type="text" id="patronymic" name="patronymic" value="<?php echo \core\session\Session::getFlash("old_input.patronymic") ?? ""; ?>">
            <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.patronymic") ?? ""; ?></span>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label" for="about">Об авторе</label>
        <textarea rows="10" class="form-control" type="text" id="about" name="about"><?php echo \core\session\Session::getFlash("old_input.about") ?? ""; ?></textarea>
        <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.about") ?? ""; ?></span>
    </div>
    <div class="row mb-3">
        <div class="col-12 col-sm-6 mb-3">
            <label class="form-label" for="birthdate">Дата рождения</label>
            <input class="form-control" type="date" id="birthdate" name="birthdate" value="<?php echo \core\session\Session::getFlash("old_input.birthdate") ?? ""; ?>">
            <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.birthdate") ?? ""; ?></span>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label class="form-label" for="diedate">Дата смерти</label>
            <input class="form-control" type="date" id="diedate" name="diedate" value="<?php echo \core\session\Session::getFlash("old_input.diedate") ?? ""; ?>">
            <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.diedate") ?? ""; ?></span>
        </div>
    </div>
    <div class="d-flex flex-row gap-2 justify-content-end">
        <button type="reset" class="btn btn-secondary">Сбросить изменения</button>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
</form>
