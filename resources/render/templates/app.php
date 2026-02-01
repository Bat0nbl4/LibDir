<!doctype html>
<html lang="ru">
<?php \core\rendering\View::IncludeComponent("base/head") ?>
<body class="d-flex flex-column min-vh-100">
    <?php \core\rendering\View::IncludeComponent("base/header") ?>
    <main class="container flex-fill">
        <?php \core\rendering\View::content() ?>
    </main>
    <?php \core\rendering\View::IncludeComponent("base/footer") ?>
</body>
</html>