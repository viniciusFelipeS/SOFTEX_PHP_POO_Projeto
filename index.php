<?php

use App\session\Login;

require_once __DIR__.'/vendor/autoload.php';

Login::iniciarSession();

include_once __DIR__.'/include/head.php';
include_once __DIR__.'/include/html/inicio.php';
include_once __DIR__.'/include/footer.php';     