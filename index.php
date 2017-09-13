<?php
// включим отображение всех ошибок
error_reporting (E_ALL); 

// подключаем конфиг
include ('config.php'); 

// Соединяемся с БД
try {
	$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
	$dbObject->exec('SET CHARACTER SET utf8');
	$dbObject->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo "БД не доступна"; die();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
}

//сессия
session_start();

// подключаем ядро сайта
include (SITE_PATH . DS . 'core' . DS . 'core.php'); 

// Загружаем router
$router = new Router();
// задаем путь до папки контроллеров.
$router->setPath (SITE_PATH . 'controllers');

//прочтем пользователя если есть
$user = array();
if (isset($_SESSION["user"]) && is_array($_SESSION["user"])) {
	$user = $_SESSION["user"];
}


// запускаем маршрутизатор

//phpinfo();

$router->start();
