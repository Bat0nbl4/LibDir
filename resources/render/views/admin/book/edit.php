<form method="POST" action="<?php echo \core\routing\Router::route("admin.book.put", ["id" => $book["id"]]) ?>" enctype="multipart/form-data">
    <p>
        Поля, помеченные символом "<b><span class="text-danger">*</span></b>" — обязательны для заполнения!
    </p>
    <div class="row mb-3">
        <div class="col-12 col-md-5 col-lg-3 mb-3">
            <img class="img-fluid w-100 cover" src="<?php echo $book["cover_url"] != null ? \core\helpers\Resource::get("img/Book/".$book["cover_url"]) : \core\helpers\Resource::get("img/system/base_img.jpg") ?>" alt="">
        </div>
        <div class="col-12 col-md-7 col-lg-9 d-flex flex-column gap-3">
            <div>
                <label class="form-label" for="author_id">Автор</label>
                <div class="d-flex flex-row gap-2">
                    <select class="form-control" name="author_id" id="author_id">
                        <option value="">---</option>
                        <?php foreach ($authors as $author): ?>
                            <option value="<?php echo $author["id"] ?>" <?php echo $author["id"] == $book["author_id"] ? "selected" : "" ?>><?php echo $author["surname"]." ".$author["name"]." ".$author["patronymic"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.author_id") ?? ""; ?></span>
            </div>
            <div>
                <label class="form-label" for="publisher_id">Издательство</label>
                <div class="d-flex flex-row gap-2">
                    <select class="form-control" name="publisher_id" id="publisher_id">
                        <option value="">---</option>
                        <?php foreach ($publishers as $publisher): ?>
                            <option value="<?php echo $publisher["id"] ?>" <?php echo $publisher["id"] == $book["publisher_id"] ? "selected" : "" ?>><?php echo $publisher["name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.publisher_id") ?? ""; ?></span>
            </div>
            <div>
                <label class="form-label" for="batch_id">Издание</label>
                <div class="d-flex flex-row gap-2">
                    <select class="form-control" name="batch_id" id="batch_id">
                        <option value="">---</option>
                        <?php foreach ($batchs as $batch): ?>
                            <option value="<?php echo $batch["id"] ?>" <?php echo $batch["id"] == $book["batch_id"] ? "selected" : "" ?>><?php echo $batch["name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.batch_id") ?? ""; ?></span>
            </div>
            <div>
                <label class="form-label" for="genre_id">Жанр</label>
                <div class="d-flex flex-row gap-2">
                    <select class="form-control" name="genre_id" id="genre_id">
                        <option value="">---</option>
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?php echo $genre["id"] ?>" <?php echo $genre["id"] == $book["genre_id"] ? "selected" : "" ?>><?php echo $genre["name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.batch_id") ?? ""; ?></span>
            </div>
            <div>
                <label class="form-label" for="cover">Обложка</label>
                <input class="form-control" type="file" id="cover" name="cover">
                <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.cover") ?? ""; ?></span>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 mb-3">
            <label class="form-label" for="title">Название<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="title" name="title" value="<?php echo \core\session\Session::getFlash("old_input.title") ?? $book["title"]; ?>" required>
            <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.title") ?? ""; ?></span>
        </div>
        <div class="col-4 mb-3">
            <label class="form-label" for="pages_count">Кол-во страниц<span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="pages_count" name="pages_count" value="<?php echo \core\session\Session::getFlash("old_input.pages_count") ?? $book["pages_count"] ?? 0; ?>" required>
            <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.pages_count") ?? ""; ?></span>
        </div>
        <div class="col-4 mb-3">
            <label class="form-label" for="count">В наличии<span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="count" name="count" value="<?php echo \core\session\Session::getFlash("old_input.count") ?? $book["count"] ?? 0; ?>" required>
            <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.count") ?? ""; ?></span>
        </div>
        <div class="col-4 mb-3">
            <label class="form-label" for="price">Цена</label>
            <input class="form-control" type="number" id="price" name="price" value="<?php echo \core\session\Session::getFlash("old_input.price") ?? $book["price"] ?? 0; ?>" required>
            <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.price") ?? ""; ?></span>
        </div>
        <div class="col-12 d-flex flex-column">
            <label class="form-label" for="description">Описание</label>
            <textarea rows="10" class="form-control" type="text" id="description" name="description"><?php echo \core\session\Session::getFlash("old_input.description") ?? $book["description"]; ?></textarea>
            <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.description") ?? ""; ?></span>
        </div>
    </div>
    <div class="d-flex flex-row gap-2 justify-content-end">
        <a href="<?php echo \core\routing\Router::route("admin.book.delete", ["id" => $book["id"]]) ?>" class="btn btn-danger">Удалить</a>
        <button type="reset" class="btn btn-secondary">Сбросить изменения</button>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
</form>