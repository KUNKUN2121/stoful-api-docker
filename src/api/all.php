<?php
require_once "database.php";
$url = $ServerURL.'/img/';
// mb_language("uni");
// mb_internal_encoding("utf-8"); //内部文字コードを変更
// mb_http_input("auto");

try{
    $stmt = $pdo->prepare("SELECT * FROM product_contents");

    // SQL実行
    $stmt->execute();
    $userData = array();
    //echo $barcode;
    //echo $content;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $userData[]=array(
        'id'=>$row['id'],
        'barnum'=>$row['barnum'],
        'category'=>$row['category'],
        'itemname'=>$row['itemname'],
        'price'=>$row['price'],
        'price'=>$row['price'],
        'quantity'=>$row['quantity'],
        'imgURL'=>$url.$row['barnum'].'.'.$row['extension'],
        // 'updated_at'=>$row['updated_at'],
        );
    }
} catch (PDOException $e) {
    // 接続できなかったらエラー表示
    echo 'error: ' . $e->getMessage();
    $return["msg"] =   $e->getMessage();
    }
    



//jsonとして出力
echo json_encode($userData);
header('Content-Type: application/json');
/////////////デバッグ用日本語で表示
// echo json_encode($person, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
