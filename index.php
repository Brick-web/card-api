<?php
$name = $_REQUEST['name'];
$type = $_REQUEST['type'];
$address = $_REQUEST['address'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$msg = $_REQUEST['msg'];
header('content-type:image/jpg');

//$img=imagecreatetruecolor(503,313);
//创建画布
$image = imagecreatetruecolor(1500,948);
//定义颜色
$black = imagecolorallocate($image, 0, 0, 0);
$width = imagecolorallocate($image, 210, 210, 210);
$blue = imagecolorallocate($image, 0, 191, 255);
//调用图片
$bgimg = "Index.jpg";
$img = imagecreatefromjpeg($bgimg);
//获取二维码
$qr =  imagecreatefromstring(file_get_contents('https://api.pe7.top/API/qr/?text='.$msg.'&size=240')); 
//imagefill($image,0,0,$bgcolor);
//合成图片
imagecopyresized($image,$img,0,0,0,0,1500,948,1500,948);
imagecopyresized($image,$qr,1050,105,0,0,240,240,240,240);
//在图片中添加内容

imagettftext($image, 100, 0, 153, 213, $black, 'font.ttf', $name);
//加粗上面的内容
imagettftext($image, 100, 0, 150, 210, $width, 'font.ttf', $name);

imagettftext($image, 50, 0, 160, 340, $width, 'font.ttf', $type);
imagettftext($image, 20, 0, 90, 420, $blue, 'font.ttf', '—————————————————————————————————————————————————');
imagettftext($image, 55, 0, 100, 530, $width, 'font.ttf', '地 址:');
imagettftext($image, 55, 0, 305, 530, $width, 'font.ttf', $address);
imagettftext($image, 55, 0, 100, 660, $width, 'font.ttf', '电 话:');
imagettftext($image, 55, 0, 305, 660, $width, 'font.ttf', $phone);
imagettftext($image, 55, 0, 100, 790, $width, 'font.ttf', '邮 箱:');
imagettftext($image, 55, 0, 305, 790, $width, 'font.ttf', $email);
imagettftext($image, 20, 0, 630, 890, $width, 'font.ttf', '@Copyright Brick-API');

//获取当前时间
$time = date("Y-m-d H:i:s");
//获取用户ip
// $ip = $_SERVER["REMOTE_ADDR"];

ob_clean();
//以当前时间命名存储生成的图片
imagejpeg($image,'image/'.$time.'-'.$name.'.jpg');
//在浏览器显示生成的图片
imagejpeg($image);


imagedestroy($qr);
imagedestroy($img);
imagedestroy($image);
?>