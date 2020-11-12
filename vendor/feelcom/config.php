<?php
// Definicja parametrów DB
define("DB_HOST", "server:port");
define("DB_USER", "db_user");
define("DB_PASS", "db_password");
define("DB_NAME", "db_name");


// Definicja protokołu, adresu witryny
define("PROTOCOL", "http://");
define("ROOT_DOMAIN", "domena/");
define("ROOT_URL", PROTOCOL . ROOT_DOMAIN);
foreach (glob("../vendor/feelcom/app/*.php") as $filename) {
    include $filename;
}
foreach (glob("../vendor/feelcom/controllers/*.php") as $filename) {
    include $filename;
}
foreach (glob("../vendor/feelcom/models/*.php") as $filename) {
    include $filename;
}