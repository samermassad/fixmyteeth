<?php
if(isset($_GET['image'])) {
    $code_base64 = $_GET['image'];
    $code_base64 = str_replace('data:image/png;base64,','',$code_base64);
    $code_binary = base64_decode($code_base64);
    $image= imagecreatefromstring($code_binary);
    header('Content-Type: image/png');
    imagejpeg($image);
    imagedestroy($image);
}