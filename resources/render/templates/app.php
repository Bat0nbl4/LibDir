<!doctype html>
<html lang="ru">
<?php \core\rendering\View::IncludeComponent("base/head") ?>
<body>
    <?php \core\rendering\View::IncludeComponent("base/header") ?>
    <main>
        <?php \core\rendering\View::content() ?>
    </main>
    <?php \core\rendering\View::IncludeComponent("base/footer") ?>
</body>
</html>