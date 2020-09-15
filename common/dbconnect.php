<?php
    try {
        $db = new PDO('mysql:dbname=php_shop;host=localhost;utf8', 'root', 'root');
    } catch(PDOException $e) {
        echo '接続エラー：' . $e->getMessage();
        exit();
    }
?>