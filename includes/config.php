<?php
session_start();


define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hospedagem');


define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/hospedagem');
define('ROOT_PATH', __DIR__ . '/..');


try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERRO: Não foi possível conectar. " . $e->getMessage());
}


function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
}

function redirect($path) {
    header("Location: " . BASE_URL . $path);
    exit();
}
?>
