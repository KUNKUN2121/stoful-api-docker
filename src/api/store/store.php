<?php
header('Content-Type: application/json');
$token = 'gzeK6Q1MWhSKzOMV';
if($_POST["token"] != $token){
    header("HTTP/1.0 401 Unauthorized");
    return;
}

require_once "../database.php";
$return["error"] = false;
$return["msg"] = "";
$barnum = $_POST["barnum"];

$date = new DateTime();
$date = $date->format('Y-m-d H:i:s');

try {
    //商品があるか確認
    $checkpro = $pdo->prepare('SELECT * FROM product_contents WHERE barnum = :barnum');
    $checkpro->bindValue(':barnum', $barnum);
    $res = $checkpro->execute();
    $check_data = $checkpro->fetch(PDO::FETCH_BOTH);
    if($check_data[2]>0){
        // 在庫あり //

        // 個数変更処理
        $stmt = $pdo->prepare('UPDATE product_contents SET quantity = quantity + -1 , updated_at = :updated_at WHERE barnum = :barnum');
        $stmt->bindValue(':barnum', $barnum);
        $stmt->bindValue(':updated_at', $date, PDO::PARAM_STR);
        $stmt->execute();

        // 売上票記入用
        $stmt = $pdo->prepare('INSERT INTO earnings (barnum, created) VALUES(:barnum, :created)');
        // $stmt->bindValue(':date', $created_at->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $stmt->bindValue(':barnum', $barnum);
        $stmt->bindValue(':created', $date, PDO::PARAM_STR);
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