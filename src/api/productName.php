<?php 
require_once "database.php";

$return["error"] = false;
$return["msg"] = "";

$barcode = $_GET['barcode'];

if($barcode!=NULL){
    $return["msg"] = "?barcode=XXXXXXXXXX";

$img = $ServerURL.'img/';

try{
    $stmt = $pdo->prepare('SELECT * FROM product_contents WHERE barnum = :barnum');
    $stmt->bindValue(':barnum', $barcode);
    $res = $stmt->execute();

    // データを取得
    if( $res ) {
        $data = $stmt->fetch();
        //値入力
        if($data[0] != null){
            $id= $data[0];
            $itemname = $data[1];
            $barcode = $data[4];
            $quantity = $data[2];
            $category = $data[9];
            $price= $data[3];
            $imgURL = $img.$barcode.'.'.$data[5];
            $like_count = $data[6];
            $created_at = $data[7];
            $uploaded_at = $data[8];
            $return = 0;
        }else{
            //登録されてない
            $itemname = 'error';
            $return = 1; // 処理終了
        }
    }
} catch (PDOException $e) {
        // なんらかのエラーが発生した。
    echo 'error: ' . $e->getMessage();
}

    // json 変換処理
    if($return == 0){
        $person = [
        'id' => $id,
        'itemname' => $itemname,
        'barcode' => $barcode,
        'quantity' => $quantity,
        'category' => $category,
        'price' => $price,
        'imgURL' => $imgURL,
        'like_count' => $like_count,
        'created_at' => $created_at,
        'uploaded_at' => $uploaded_at,

        ];
    }
    else{
        $person = [
            'id' => $null,
            // 'msg' => ;
        ];
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json');
    }
}
        header('Content-Type: application/json');
        echo json_encode($person);
        /////////////デバッグ用日本語で表示
        // echo json_encode($person, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>