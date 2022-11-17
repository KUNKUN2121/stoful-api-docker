<?php
require_once "database.php";
$url = $ServerURL.'img/';
$order = $_GET['order'];
$search = $_GET['search'];

// serachある場合


// カテゴリー設定がある場合
$category = $_GET['category'];
if($category>=1 && $category <=5){
    $sql = "SELECT * FROM product_contents WHERE (category = :category AND (itemname LIKE :search OR barnum LIKE :search)) ORDER BY itemname";
}else{
    $sql = "SELECT * FROM product_contents WHERE (itemname LIKE :search OR barnum LIKE :search) ORDER BY itemname";
}


try{
    $stmt = $pdo->prepare($sql);
    // 代入
    $stmt->bindValue(":search", '%'. $search .'%', PDO::PARAM_STR);
    $stmt->bindValue(':category', $category);
    // $stmt->bindValue(':order', $order);

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
header('Content-Type: application/json');
echo json_encode($userData);

/////////////デバッグ用日本語で表示
// echo json_encode($person, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
