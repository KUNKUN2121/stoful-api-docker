<?php
require_once "database.php";


$return["error"] = false;
$return["msg"] = "";


$barnum = $_POST["barnum"];
$quantity = $_POST["quantity"];


//array to return

        try{
        $stmt = $pdo->prepare('UPDATE product_contents SET quantity = :quantity WHERE barnum = :barnum');
        // 値をセット
        $stmt->bindValue(':barnum', $barcode);
        $stmt->bindValue(':quantity', $quantity);
    
        // SQL実行
        $stmt->execute();
        echo('データベース追加しました。');
    } catch (PDOException $e) {
        // 接続できなかったらエラー表示
        echo 'error: ' . $e->getMessage();
        $return["msg"] =   $e->getMessage();
        }

header('Content-Type: application/json');
// tell browser that its a json data
echo json_encode($return);
//converting array to JSON string



    
?>