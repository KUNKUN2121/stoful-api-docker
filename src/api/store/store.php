<?php
// token認証
$token = 'gzeK6Q1MWhSKzOMV';
if($_POST["token"] != $token){
    header("HTTP/1.0 401 Unauthorized");
    return;
}
header('Content-Type: application/json');
require_once "../database.php";

$return["error"] = false;
$return["msg"] = "";

$barnum = $_POST["barnum"];


try {
    //商品があるか確認
    $checkpro = $pdo->prepare('SELECT * FROM product_contents WHERE barnum = :barnum');
    $checkpro->bindValue(':barnum', $barnum);
    $res = $checkpro->execute();
    $check_data = $checkpro->fetch(PDO::FETCH_BOTH);
    if($check_data[2]>0){
        // 在庫あり //

        // 個数変更処理
        $stmt = $pdo->prepare('UPDATE product_contents SET quantity = quantity + -1 , updated_at = NOW() WHERE barnum = :barnum');
        $stmt->bindValue(':barnum', $barnum);
        $stmt->execute();

        // 売上票記入用
        $stmt = $pdo->prepare('INSERT INTO earnings (barnum, created) VALUES(:barnum, NOW())');
        $stmt->bindValue(':barnum', $barnum);
        $stmt->execute();
        $return["msg"] = 'Done itemname : '. $check_data[1]; 

    }else{
        // 在庫なし、存在しない //
        $return["error"] = true;
        $return["msg"] = "NoZaiko or Sonzainasi";
    }
} catch (\Throwable $e) {
    $return["error"] = true;
    $return["msg"] = $e;
}

echo json_encode($return , JSON_UNESCAPED_UNICODE);
?>