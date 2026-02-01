<!doctype html>
<html lang="ru">
<?php \core\rendering\View::IncludeComponent("base/head") ?>
<body class="d-flex flex-column min-vh-100">
    <?php \core\rendering\View::IncludeComponent("base/header") ?>
    <div class="border-bottom mb-3">
        <ul class="nav container justify-content-center">
            <?php if (\core\session\Session::get("user.role.sys_name") == "admin"): ?>
                <li><a href="<?php echo \core\routing\Router::route("admin.order.list") ?>" class="nav-link text-success px-2">Заказы</a></li>
                <li><a href="<?php echo \core\routing\Router::route("admin.book.list") ?>" class="nav-link px-2">Книги</a></li>
                <li><a href="<?php echo \core\routing\Router::route("admin.author.list") ?>" class="nav-link px-2">Авторы</a></li>
                <li><a href="<?php echo \core\routing\Router::route("admin.publisher.list") ?>" class="nav-link px-2">Издатели</a></li>
                <li><a href="<?php echo \core\routing\Router::route("admin.batch.list") ?>" class="nav-link px-2">Издания</a></li>
                <li><a href="<?php echo \core\routing\Router::route("admin.genre.list") ?>" class="nav-link px-2">Жанры</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <main class="container flex-fill">
        <?php \core\rendering\View::content() ?>
    </main>
    <?php \core\rendering\View::IncludeComponent("base/footer") ?>
</body>
</html>