<?php

require './config.php';
require './database.php';

if( !isset($_SESSION['auth111']) ) {
    jsonResponse('error', '401 Unauthorized');
}

$openid = $_SESSION['auth111']['openid'];
$mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : null;

if( empty($mobile) ) {
    jsonResponse('error', '请填写手机号！');
}

$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$query = $db->query(sprintf('SELECT * FROM kamen_mobile WHERE openid = "%s" AND mobile = "%s"', $openid, $mobile));

if( $query->num_rows() ) {
    jsonResponse('error', '您已经提交过手机号了，请不要重复提交！');
}

$array = array(
    'openid' => $openid,
    'mobile' => $mobile
);

if( !$db->insert('kamen_mobile', $array) ) {
    jsonResponse('error', '提交失败请重试！');
}

jsonResponse('success', '恭喜，您已提交成功！');
