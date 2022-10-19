<?php

$return["error"] = true;
$return["msg"] = "Noting";

if(isset($_POST["image"])){
    $base64_string = $_POST["image"];
    $decode_data = base64_decode($base64_string);
    $data_dir = 'temp';




    ///
    $random = md5(uniqid(rand(), true)).".jpg";
    ///

    $im = new Imagick();
    $im->pingImageBlob($decode_data);
    $org_width  = $im->getImageWidth();
    $org_height = $im->getImageHeight();
    // echo 'original image size : ' . $org_width . ' x ' . $org_height ."<br>\n";

    $size = $org_width;
    if ( $org_width > $org_height){ $size = $org_height; }

    $width  = $size;
    $height = $size;
    // readImageにBloobにするとパスではなく直で読み込む
    $im->readImageBlob($decode_data);
    $im->autoOrient();
    $im->cropThumbnailImage($width, $height);
    $im->writeImage("{$data_dir}/$random");
    // echo 'original image size : ' . $width . ' x ' . $height ."<br>\n";
    // https://pgmemo.tokyo/data/archives/994.html

    //出力
    // header('Content-type: image/jpg');
    // echo $decode_data;
    // echo 'original image size : ' . $org_width . ' x ' . $org_height ."<br>\n";
    // echo 'original image size : ' . $width . ' x ' . $height ."<br>\n";
    $return["error"] = false;
    $return["msg"] = "https://store-project.f5.si/database/api/temp/".$random;
}
header('Content-Type: application/json');
// tell browser that its a json data
echo json_encode($return);
//converting array to JSON string

?>