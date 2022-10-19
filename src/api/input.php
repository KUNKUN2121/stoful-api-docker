<?php
    //データベース接続
    try {
        $dsn = 'mysql:dbname=store;host=localhost;charset=utf8mb4';
        $username ='store';
        $password = 'vGciFPmVGTdd86R682U75MfNdzAQMg';
    
        $pdo = new PDO($dsn, $username, $password, $driver_options);
        // 入力した値をデータベースへ登録
        } catch (PDOException $e) {
        echo 'DB接続エラー!: ' . $e->getMessage();
    }

    // json受け取り
    try {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        //データ代入
        $end = count($data);
        echo $end;
    } catch (\Throwable $th) {
        echo('このAPIは在庫追加用です。<div> POSTメソッドで送信してください。 <div>');
        echo('<div><div> errorcode<div>');
        echo $th;
    }

    for ($i = 0; $i < $end; $i++) {
        $barcode = $data[$i][0];
        $quantity = $data[$i][1];

        try{
            $stmt = $pdo->prepare('UPDATE product_contents SET quantity = quantity + :quantity WHERE barnum = :barnum');
            $stmt->bindValue(':barnum', $barcode);
            $stmt->bindValue(':quantity', $quantity);
            //実行
            $res = $stmt->execute();
            $count=$stmt->rowCount();
    
            // データを取得
            if( $res == true) {
                // 何個変えた？
                if($count >= 1){
                    echo($barcode .' : '. $count . ' 変更したよ <div>');
                }else{
                    echo('変更なし');
                }
            }else{
                echo('resあるけど countない');
            }
    
        } catch (PDOException $e) {
            echo('データベースエラー<div>');
            // 接続できなかったらエラー表示
            echo 'error: ' . $e->getMessage();
        }

    }
    // foreach($data as $i){
    //     $barcode = $data[$i][0];
    //     $quantity = $data[$i][1];
    //     echo($barcode.' 個数は '.$quantity.'<div>');
    // }

    


    //// debug /////
        // echo($barcode.'<div>');
        // echo($quantity.'<div>');
    //// debug ////
    




?>