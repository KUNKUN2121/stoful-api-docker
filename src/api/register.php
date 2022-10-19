<?php
require_once "database.php";


$return["error"] = false;
$return["msg"] = "";


// $return["itemname"] = $_POST["itemname"];
// $return["barnum"] = $_POST["barnum"];
// $return["quantity"] = $_POST["quantity"];
// $return["category"] = $_POST["category"];
// $return["price"] = $_POST["price"];

$itemname = $_POST["itemname"];
$barnum = $_POST["barnum"];
$quantity = $_POST["quantity"];
$category = $_POST["category"];
$price = $_POST["price"];
$extension = 'jpg';



//array to return
if(isset($_POST["image"])){
    // $base64_string = $_POST["image"];
    // $outputfile = "../../img/".$barnum.".jpg" ;
    // //save as image.jpg in uploads/ folder

    // $filehandler = fopen($outputfile, 'wb' ); 
    // //file open with "w" mode treat as text file
    // //file open with "wb" mode treat as binary file
    
    // fwrite($filehandler, base64_decode($base64_string));
    // // we could add validation here with ensuring count($data)>1

    // // clean up the file resource
    // fclose($filehandler); 
    $image = file_get_contents($_POST["image"]);

    $save_path = "../../img/".$barnum.".jpg" ;

    file_put_contents($save_path, $image);


        try{
        $stmt = $pdo->prepare('INSERT INTO product_contents (itemname, barnum, extension, quantity, category, price, created_at, updated_at) VALUES(:itemname, :barnum, :extension, :quantity, :category, :price, NOW(), NOW() )');

        // 値をセット
        $stmt->bindValue(':itemname', $itemname);
        $stmt->bindValue(':barnum', $barnum);
        $stmt->bindValue(':extension', $extension);
        $stmt->bindValue(':quantity', $quantity);
        $stmt->bindValue(':category', $category);
        $stmt->bindValue(':price', $price);
        // $stmt->bindValue(':created_at', '22');
    
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
    $return["error"] = true;
    $return["msg"] =  "No image is submited.";
}

header('Content-Type: application/json');
// tell browser that its a json data
echo json_encode($return);
//converting array to JSON string



    
?>