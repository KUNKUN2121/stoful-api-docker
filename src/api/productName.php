<?php 
require_once "database.php";
$barcode = $_GET['barcode'];
if($barcode==NULL){
    echo('productName.php?barcode=222224');
    return;
}
$img = 'https://store-project.f5.si/img/';
    // itemname 取得
        try{
            //$barcode = 4549131970258;
            $stmt = $pdo->prepare('SELECT itemname FROM product_contents WHERE barnum = :barnum');
            $stmt->bindValue(':barnum', $barcode);
            //実行
            $res = $stmt->execute();

            // データを取得
            if( $res ) {
                $data = $stmt->fetch();
                //表示処理
                if($data[0] != null){
                    $itemname  = $data[0];
                    $return = 0; // 完了通知
                }else{
                    //登録されてない
                    $itemname = 'error';
                    $return = 1; // 処理終了
                }
            }
        } catch (PDOException $e) {
            // 接続できなかったらエラー表示
            echo 'error: ' . $e->getMessage();
        }
    //拡張子取得
        try{
            $stmt = $pdo->prepare('SELECT extension FROM product_contents WHERE barnum = :barnum');
            $stmt->bindValue(':barnum', $barcode);
            //実行
            $res = $stmt->execute();

            // データを取得
            if( $res ) {
                $data = $stmt->fetch();
                //表示処理
                if($data[0] != null){
                    $extension = $data[0];
                    $imgURL = $img.$barcode.'.'.$extension;
                    
                }else{
                    // 拡張子がない
                    $imgURL = 'nasi';
                    $return = 1; // 処理終了
                }
            }
        } catch (PDOException $e) {
            // 接続できなかったらエラー表示
            echo 'error: ' . $e->getMessage();
        }


        // 個数 取得
        try{
            //$barcode = 4549131970258;
            $stmt = $pdo->prepare('SELECT quantity FROM product_contents WHERE barnum = :barnum');
            $stmt->bindValue(':barnum', $barcode);
            //実行
            $res = $stmt->execute();

            // データを取得
            if( $res ) {
                $data = $stmt->fetch();
                //表示処理
                if($data[0] !== null){
                    $quantity  = $data[0];
                    $return = 0; // 完了通知
                }else{
                    //登録されてない
                    $itemname = 'error';
                    $return = 1; // 処理終了
                }
            }
        } catch (PDOException $e) {
            // 接続できなかったらエラー表示
            echo 'error: ' . $e->getMessage();
        }



    // json 変換処理
    if($return == 0){
        $person = [
        'itemname' => $itemname,
        'barcode' => $barcode,
        'quantity' => $quantity,
        'category' => 'todocategory',
        'price' => 1000,
        'imgURL' => $imgURL,
        ];
        header('Content-Type: application/json');
        echo json_encode($person);
        /////////////デバッグ用日本語で表示
        // echo json_encode($person, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    // 登録情報なし
    }elseif ($return == 1){
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json');
        echo('存在しません。');
    // $returnが定義されていない サーバエラー
    }else{
        header('HTTP/1.1 500 Internal Server Error');
    }
?>