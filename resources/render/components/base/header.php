<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none gap-2 me-3">
                <img class="logo-img" src="<?php echo \core\helpers\Resource::get("img/system/logo.svg") ?>">
                <div class="logo-text hidden-350">
                    <span>Книжнй магазин</span>
                    <h4>LibDir</h4>
                </div>
            </a>

            <ul class="nav col-12 col-md-auto me-md-auto mb-2 justify-content-center mb-lg-0">
                <?php if (\core\session\Session::get("user.role.sys_name") == "admin"): ?>
                    <li><a href="<?php echo \core\routing\Router::route("admin.order.list") ?>" class="nav-link px-2">Панель администратора</a></li>
                <?php endif; ?>
            </ul>

            <div class="col-auto px-1 d-flex flex-row gap-2 align-items-center">
                <?php if (\core\session\Session::has("user")): ?>
                    <a href="<?php echo \core\routing\Router::route("lk") ?>" class="btn btn-primary w-100"><?php echo \core\session\Session::get("user.name") ?></a>
                    <?php if (\core\session\Session::has("basket")): ?>
                        <a href="<?php echo \core\routing\Router::route("user.basket") ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-basket3" viewBox="0 0 16 16">
                                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6z"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo \core\routing\Router::route("login") ?>" class="btn btn-primary w-100">Войти</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>