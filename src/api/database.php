<?php
try {
    $dsn = 'mysql:dbname=store;host=store-project.f5.si;charset=utf8mb4';
    $username ='store';
    $password = 'vGciFPmVGTdd86R682U75MfNdzAQMg';

    $pdo = new PDO($dsn, $username, $password, $driver_options);
    // 入力した値をデータベースへ登録
    } catch (PDOException $e) {
    echo 'DB接続エラー!!!!: ' . $e->getMessage();
    
}
$ServerURL = 'https://store-project.f5.si/';
?>