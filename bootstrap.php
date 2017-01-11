<?php

define('APP_ROOT', __DIR__);
define('STORAGE_ROOT', APP_ROOT.'/storage');

require_once APP_ROOT.'/vendor/autoload.php';
(new Dotenv\Dotenv(APP_ROOT))->load();
