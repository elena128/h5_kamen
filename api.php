<?php

require './config.php';
require './database.php';

if( !isset($_SESSION['auth111']) ) {
    jsonResponse('error', '401 Unauthorized');
}

$pic    = isset($_POST['pic']) ? trim($_POST['pic']) : null;
$text1  = isset($_POST['text1']) ? trim($_POST['text1']) : null;
$text2  = isset($_POST['text2']) ? trim($_POST['text2']) : null;

if( empty($pic) ) {
    jsonResponse('error', 'Pic is required');
}

if( mb_substr($pic, 0, 10) !== 'data:image' ) {
    jsonResponse(array('error'=>'无效的图片数据！'));
}

$token  = uniqid(date('ymd'));
$encode = explode(',', $pic);
$target = sprintf('attachments/%s.jpg', $token);

file_put_contents($target, base64_decode($encode[1]));

if( !file_exists($target) ) {
    jsonResponse('error', 'Unable to upload');
}

// if( empty($text1) ) {
//     jsonResponse('error', 'text1 is required');
// }

// if( empty($text2) ) {
//     jsonResponse('error', 'text2 is required');
// }

$array = array(
    'token'     => $token,
    'text1'     => $text1,
    'text2'     => $text2,
    'pic'       => $target,
    'openid'    => $_SESSION['auth111']['openid'],
    'nickname'  => $_SESSION['auth111']['nickname'],
    'headimgurl'=> $_SESSION['auth111']['headimgurl']
);

$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if( !$db->insert('kamen', $array) ) {
    jsonResponse('error', 'Unable to save');
}

jsonResponse('success', $token);
