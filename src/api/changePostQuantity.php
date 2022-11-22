<?php
header('Content-Type: application/json');
require_once "database.php";

// 初期値設定
$return["error"] = false;
$return["moreinfo"] = false;
$return["msg"] = "";

// POSTの値を取得
$barnum = $_POST["barnum"];
$quantity = $_POST["quantity"];

//確認用
$return["barnum"] = $barnum;
$return["quantity"] = $quantity;

// moreinfo 0の場合
if($_POST["moreinfo"]==0){
    $return["moreinfo"] = false;
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
    }else{
        // moreinfo 詳細設定
        $return["moreinfo"] = true;
        $itemname = $_POST["itemname"];
        $price = $_POST["price"];
        $category = $_POST["category"];
        $imgURL = $_POST["image"];
        $return["itemname"] = $itemname;
        $return["price"] = $price;
        $return["category"] = $category;
        $return["imgURL"] = $imgURL;
        $extension = 'jpg';

        if(isset($_POST["image"])){
            $image = file_get_contents($_POST["image"]);
        
            $save_path = "../img/".$barnum.".jpg" ;
        
            file_put_contents($save_path, $image);
        }
        try{
            // $stmt = $pdo->prepare('INSERT INTO product_contents (itemname, barnum, extension, quantity, category, price, created_at, updated_at) VALUES(:itemname, :barnum, :extension, :quantity, :category, :price, NOW(), NOW() )');
            $stmt = $pdo->prepare('UPDATE product_contents SET itemname = :itemname, price = :price, category = :category WHERE barnum = :barnum');
    
            // 値をセット
            $stmt->bindValue(':barnum', $barnum);
            $stmt->bindValue(':itemname', $itemname);
            $stmt->bindValue(':price', $price);
            $stmt->bindValue(':category', $category);
        
            // SQL実行
            $stmt->execute();
            echo('DataBaseAdd');
            $return["msg"] = 'データベース追加しました。';
            //echo $barcode;
            //echo $content;
        } catch (PDOException $e) {
            // 接続できなかったらエラー表示
            // echo 'error: ' . $e->getMessage();
            $return["error"] = true;
            $return["msg"] =   $e->getMessage();
            }

    }

// tell browser that its a json data
echo json_encode($return);
//converting array to JSON string



    
?>