<header class="fixed-top header bg-white p-2" id="header">
    <div class="container d-flex flex-wrap flex-row justify-content-center align-items-center gap-2">
        <a class="d-flex flex-row text-decoration-none me-auto logo" href="<?php echo \core\routing\Router::route("index") ?>">
            <img class="img-fluid logo-img" src="<?php echo \core\helpers\Resource::get("img/app/icon.svg") ?>">
            <span class="text-main logo-text">
                КРАЕВОЙ<br>
                ДВОРЕЦ<br>
                МОЛОДЕЖИ
            </span>
        </a>
        <ul class="d-none d-lg-flex flex-row navbar-nav nav-pills gap-2 me-2">
            <li class="nav-item"><a class="nav-link p-1" href="<?php echo \core\routing\Router::route("about") ?>">О нас</a></li>
            <li class="nav-item"><a class="nav-link p-1" href="<?php echo \core\routing\Router::route("contacts") ?>">Контакты</a></li>
            <li class="nav-item"><a class="nav-link p-1" href="<?php echo \core\routing\Router::route("residents") ?>">Резиденты</a></li>
            <li class="nav-item"><a class="nav-link p-1" href="<?php echo \core\routing\Router::route("event.list") ?>">Афиша</a></li>
        </ul>
        <div class="d-flex flex-row gap-2">
            <?php if (\core\session\Session::has("user")): ?>
                <a class="btn btn-main" href="<?php echo \core\routing\Router::route("user.lk") ?>">Мой кабинет</a>
            <?php else: ?>
                <a class="btn btn-main" href="<?php echo \core\routing\Router::route("user.login") ?>">Войти</a>
                <a class="btn btn-outline-main" href="<?php echo \core\routing\Router::route("user.registration") ?>">Регистрация</a>
            <?php endif; ?>
            <nav class="navbar navbar-expand-lg p-0 d-lg-none">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Переключатель навигации">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </div>
        <div class="d-lg-none collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav nav-pills gap-2 me-2">
                <li class="nav-item"><a class="nav-link p-1" href="<?php echo \core\routing\Router::route("about") ?>">О нас</a></li>
                <li class="nav-item"><a class="nav-link p-1" href="<?php echo \core\routing\Router::route("residents") ?>">Резиденты</a></li>
                <li class="nav-item"><a class="nav-link p-1" href="<?php echo \core\routing\Router::route("contacts") ?>">Контакты</a></li>
                <li class="nav-item"><a class="nav-link p-1" href="<?php echo \core\routing\Router::route("event.list") ?>">Афиша</a></li>
            </ul>
        </div>
    </div>

</header>