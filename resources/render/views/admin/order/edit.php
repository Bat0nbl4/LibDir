<form method="POST" action="<?php echo \core\routing\Router::route("admin.order.put", ["id" => $order["id"]]) ?>" enctype="multipart/form-data">
    <div class="row mb-3">
        <?php foreach ($order_items as $item): ?>
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <a href="<?php echo \core\routing\Router::route("book.show", ["id" => $item["book_id"]]) ?>">
                    <img class="img-fluid cover" src="<?php echo $item["cover_url"] != null ? \core\helpers\Resource::get("img/Book/".$item["cover_url"]) : \core\helpers\Resource::get("img/system/base_img.jpg") ?>" alt="">
                </a>
                <?php \core\rendering\View::IncludeComponent("param", ["key" => "Цена", "value" => $item["price"]]); ?>
                <?php \core\rendering\View::IncludeComponent("param", ["key" => "Количество", "value" => $item["count"]]); ?>
                <?php \core\rendering\View::IncludeComponent("param", ["key" => "Итого", "value" => $item["price"] * $item["count"]]); ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="mb-3">
        <label class="form-label" for="status">Статус</label>
        <div class="d-flex flex-row gap-2">
            <select class="form-control" name="status" id="status">
                <?php foreach (["Ожидает оплаты", "Собирается", "В пути", "Доставлен", "Получен"] as $status): ?>
                    <option value="<?php echo $status ?>" <?php echo $status == $order["status"] ? "selected" : "" ?>><?php echo $status ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <span class="text-danger"><?php echo \core\session\Session::getFlash("input_errors.batch_id") ?? ""; ?></span>
    </div>
    <div class="d-flex flex-row gap-2 justify-content-end">
        <a href="<?php echo \core\routing\Router::route("admin.order.delete", ["id" => $order["id"]]) ?>" class="btn btn-danger">Удалить</a>
        <button type="reset" class="btn btn-secondary">Сбросить изменения</button>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
</form>