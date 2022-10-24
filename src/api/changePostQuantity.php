<?php
require_once "database.php";
header('Content-Type: application/json');

$return["error"] = false;
$return["msg"] = "";

$return["barnum"] = $_POST["barnum"];
$return["quantity"] = $_POST["quantity"];

$barnum = $_POST["barnum"];
$quantity = $_POST["quantity"];

        try{
        // $stmt = $pdo->prepare('INSERT INTO product_contents (itemname, barnum, extension, quantity, category, price, created_at, updated_at) VALUES(:itemname, :barnum, :extension, :quantity, :category, :price, NOW(), NOW() )');
        $stmt = $pdo->prepare('UPDATE product_contents SET quantity = :quantity WHERE barnum = :barnum');

        // 値をセット
        $stmt->bindValue(':barnum', $barnum);
        $stmt->bindValue(':quantity', $quantity);
    
        // SQL実行
        $stmt->execute();
        echo('データベース追加しました。');
        //echo $barcode;
        //echo $content;
    } catch (PDOException $e) {
        // 接続できなかったらエラー表示
        echo 'error: ' . $e->getMessage();
        $return["msg"] =   $e->getMessage();
        }


// tell browser that its a json data
echo json_encode($return);
//converting array to JSON string



    
?>