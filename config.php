<?php
// Задаем константы:
define ('DS', DIRECTORY_SEPARATOR); // разделитель для путей к файлам
$sitePath = realpath(dirname(__FILE__) . DS) . DS;
define ('SITE_PATH', $sitePath); // путь к корневой папке сайта

define ('SITE_URL', "http://".$_SERVER["HTTP_HOST"]."/");

// для подключения к бд
define('DB_USER', 'root');
define('DB_PASS', 'gold');
define('DB_HOST', 'localhost');
define('DB_NAME', 'test-phonebook');

ini_set ( 'display_errors', 1 );
