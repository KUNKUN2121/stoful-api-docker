<?php
require_once "vendor/autoload.php";
require_once "database.php";

$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
// echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('081231723897', $generator::TYPE_CODE_128)) . '">';


// SELECT文を変数に格納
$sql = "SELECT * FROM product_contents";
 
// SQLステートメントを実行し、結果を変数に格納
$stmt = $pdo->query($sql);
 
// foreach文で配列の中身を一行ずつ出力
foreach ($stmt as $row) {
 
  // データベースのフィールド名で出力
  echo $row['itemname'];
  echo '<br>';
  echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row['barnum'], $generator::TYPE_CODE_128)) . '">';
  echo '<br>';
  echo $row['barnum'];
//   echo $row['barnum'];
  echo '<br>';
  echo '<br>';
  echo '<br>';
  echo '<br>';
 
  // 改行を入れる
  echo '<br>';
}




// try{
//     //$barcode = 4549131970258;
//     $stmt = $pdo->prepare('SELECT barnum FROM product_contents');
//     //実行
//     $res = $stmt->execute();

//     // データを取得
//     if( $res ) {
//         $data = $stmt->fetch();
//         if($data[0] != null){
//             var_dump($data);
//         }else{
//             echo('imgURL.php?barocde=00000');
//         }
//     }

// } catch (PDOException $e) {
//     // 接続できなかったらエラー表示
//     echo 'error: ' . $e->getMessage();
// }
?>