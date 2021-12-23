<?php
// 数据库设置
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'xxxx');
define('DB_NAME', 'tms');
// 建立数据库联系

try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    exit("数据库连接错误" . $e->getMessage());
}
?>

