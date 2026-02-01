<?php

require_once "config/config.php";
require_once "config/server_config.php";
require_once "config/db_conn.php";

ini_set('session.save_path', __DIR__ . SESSION_STORAGE ?? "/storage/sessions");

require_once "autoload.php";
require_once "routes/routes.php";

use core\session\Session;
use core\routing\Router;

Session::clearFlash();
Router::resolve();