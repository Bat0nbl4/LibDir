<form method="POST" action="<?php echo \core\routing\Router::route("admin.publisher.store") ?>" enctype="multipart/form-data">
    <p>
        Поля, помеченные символом "<b><span class="text-danger">*</span></b>" — обязательны для заполнения!
    </p>
    <div class="row mb-3">
        <div class="col-12">
            <label class="form-label" for="name">Название<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="name" name="name" value="<?php echo \core\session\Session::getFlash("old_input.name") ?? ""; ?>" required>
            <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.name") ?? ""; ?></span>
        </div>
    </div>
    <div class="d-flex flex-row gap-2 justify-content-end">
        <button type="reset" class="btn btn-secondary">Сбросить изменения</button>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
</form>