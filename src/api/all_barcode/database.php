<?php
try {
    $dsn = 'mysql:dbname=store;host=localhost;charset=utf8mb4';
    $username ='store';
    $password = 'vGciFPmVGTdd86R682U75MfNdzAQMg';

    $pdo = new PDO($dsn, $username, $password, $driver_options);
    // 入力した値をデータベースへ登録
    } catch (PDOException $e) {
    echo 'DB接続エラー!: ' . $e->getMessage();
}
?>