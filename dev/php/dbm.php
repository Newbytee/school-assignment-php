<?php
$_host = '127.0.0.1';
$_db   = 'c9';
$_user = 'newbyte';
$_pass = '';
$_charset = 'utf8mb4';

$_dsn = "mysql:host=$_host;dbname=$_db;charset=$_charset";
$_options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($_dsn, $_user, $_pass, $_options);
} catch (\PDOException $_e) {
     throw new \PDOException($_e->getMessage(), (int)$_e->getCode());
}
?>