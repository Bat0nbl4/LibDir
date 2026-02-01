<?php \core\rendering\View::title("Личный кабинет"); ?>
<?php $user = \core\session\Session::get("user") ?>
<h2><?php echo $user["surname"]." ".$user["name"]." ".$user["patronymic"] ?></h2>
<p>Дата рождения: <?php echo \core\helpers\Date::normal_date($user["birthdate"]) ?? "Не указана" ?></p>
<p>Номер телефона: <?php echo $user["phone"] != null ? $user["phone"] : "Не указан" ?></p>
<p>Электронная почта: <?php echo $user["email"] ?? "Не указана" ?></p>
<?php if (\core\session\Session::has("user.role")): ?>
    <p>Роль: <?php echo \core\session\Session::get("user.role.name") ?></p>
<?php endif; ?>
<a class="btn btn-outline-danger" href="<?php echo \core\routing\Router::route("logout"); ?>">Выйти</a>

<h3 class="my-3">Ваши заказы</h3>
<?php if (!empty($orders)): ?>
    <table class="table table-hover">
        <thead class="border-bottom border-black">
        <tr>
            <th>Номер заказа</th>
            <th>Итого</th>
            <th>Статус</th>
            <th>Время оформления заказа</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order["id"] ?></td>
                <td><?php echo $order["sum"] ?></td>
                <td class="
                    <?php echo $order["status"] == "Ожидает оплаты" ? "text-warning" : "" ?>
                    <?php echo $order["status"] == "Собирается" ? "text-info" : "" ?>
                    <?php echo $order["status"] == "В пути" ? "text-info" : "" ?>
                    <?php echo $order["status"] == "Доставлен" ? "text-success" : "" ?>
                    <?php echo $order["status"] == "Получен" ? "text-secondary" : "" ?>
                "><?php echo $order["status"] ?></td>
                <td><?php echo \core\helpers\Date::normal_date($order["created_at"]) ?> <?php echo \core\helpers\Date::normal_time($order["created_at"]) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center align-items-center gap-1 fs-4">
        <a class="text-decoration-none <?php echo $current_page > 1 ? "text-primary" : "text-secondary" ?>" href="<?php echo $current_page > 1 ? \core\routing\Router::route("lk", ["page" => 1]) : "" ?>">⋘</a>
        <a class="text-decoration-none <?php echo $current_page - 1 >= 1 ? "text-primary" : "text-secondary" ?>" href="<?php echo $current_page - 1 >= 1 ? \core\routing\Router::route("lk", ["page" => $current_page - 1]) : "" ?>"><</a>
        <a class="text-decoration-none"><?php echo $current_page ?></a>
        <a class="text-decoration-none <?php echo $current_page + 1 <= $page_count ? "text-primary" : "text-secondary" ?>" href="<?php echo $current_page + 1 <= $page_count ? \core\routing\Router::route("lk", ["page" => $current_page + 1]) : ""?>">></a>
        <a class="text-decoration-none <?php echo $current_page < $page_count ? "text-primary" : "text-secondary" ?>" href="<?php echo $current_page < $page_count ? \core\routing\Router::route("lk", ["page" => $page_count]) : "" ?>">⋙</a>
    </div>
<?php else: ?>
    <span class="w-100 text-muted">Вы не совершили ни одного заказа.</span>
<?php endif; ?>
