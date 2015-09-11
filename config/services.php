<?php
$container = new \King23\DI\Interop\InteropContainer();

// ensure we have an APP_PATH (optional)
if (!defined("APP_PATH")) {
    define('APP_PATH', __DIR__."/..");
}

// to keep this example small we use the basic configuration
// of castle23's config. you can copy and override if you need to change
// anything (the logger for example)
require_once APP_PATH."/vendor/king23/castle23/config/services/console.php";
require_once APP_PATH."/vendor/king23/castle23/config/services/knight23.php";
require_once APP_PATH."/vendor/king23/castle23/config/services/logger.php";
require_once APP_PATH."/vendor/king23/castle23/config/services/react.php";
require_once APP_PATH."/vendor/king23/castle23/config/services/settings.php";


// the here we configure the http services, so it loads slim as a middleware
require_once APP_PATH."/config/services/http.php";

// add the defaults to the DI container
require_once APP_PATH."/config/services/slim.php";

// and the file where we actually create the slim instance
require_once APP_PATH."/config/services/slim-app.php";

return $container;
