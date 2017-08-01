<?php

/**
 * 错误消息等级
 */
error_reporting(E_ALL);

/**
 * 是否显示错误
 */
ini_set('display_errors', 1);

/**
 * Session
 */
session_start();
/**
 * 参数设置
 */
define('DB_HOST',       'rdsoadc9tm7ru2yzclctepublic.mysql.rds.aliyuncs.com');
define('DB_NAME',       'activity');
define('DB_USER',       'funx');
define('DB_PASS',       'funx123456');
define('DB_CHARSET',    'utf8');

/**
 * 响应 JSON
 */
function jsonResponse($code, $message = null)
{
    $data = array('code'=>$code);

    if( !is_null($message) ) {
        $data['message'] = $message;
    }

    header('Content-Type: application/json');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * 过滤微信昵称
 */
function filterNickname($nickname)
{
    // Match Emoticons
    $nickname = preg_replace('/[\x{1F600}-\x{1F64F}]/u', '', $nickname);
    // Match Miscellaneous Symbols and Pictographs
    $nickname = preg_replace('/[\x{1F300}-\x{1F5FF}]/u', '', $nickname);
    // Match Transport And Map Symbols
    $nickname = preg_replace('/[\x{1F680}-\x{1F6FF}]/u', '', $nickname);
    // Match Miscellaneous Symbols
    $nickname = preg_replace('/[\x{2600}-\x{26FF}]/u', '', $nickname);
    // Match Dingbats
    $nickname = preg_replace('/[\x{2700}-\x{27BF}]/u', '', $nickname);

    return trim($nickname);
}

/**
 * 自动加载
 */
require __DIR__.'/vendor/autoload.php';

use Thenbsp\Wechat\Wechat;
use Thenbsp\Wechat\AccessToken;
use Thenbsp\Wechat\Util\Cache;

/**
 * Wechat 对象
 */
// $wechat = new Wechat(array(
//     'appid'     => 'wxd8da84ed2a26aa06',
//     'appsecret' => '00e6fd3ce1151e3d2bd0e01c98c925d3'
// ));

$wechat = new Wechat(array(
    'appid'     => 'wxc3a68592f62e0f91',
    'appsecret' => 'b96c9dfa7522718c3b57c34b83aa55cc'
));

/**
 * Cache 对象
 */
$cache = new Cache(__DIR__.'/cache_data_files');

/**
 * AccessToken 对象
 */
$accessToken = new AccessToken($wechat, $cache);
