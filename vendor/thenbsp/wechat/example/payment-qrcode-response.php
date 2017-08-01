<?php

require './example.php';

use Thenbsp\Wechat\Payment\QrcodeRequest;
use Thenbsp\Wechat\Payment\QrcodeResponse;

/**
 *  第一步：处理请求
 */
$request = new QrcodeRequest();

if( !$request->isValid() ) {
    // 代码层的错误不要呈现给用户，写到日志中
    $cache->set('payment-qrcode-response-error', $request->getError());
    // 给用户返回个 "Invalid Request"，或者其它的
    QrcodeResponse::fail('Invalid Request');
}

/**
 * 第二步：响应订单（统一下单）
 */
$options = array(
    'body' => 'iphone 6 plus',
    'total_fee' => 1,
    'out_trade_no' => date('YmdHis').mt_rand(10000, 99999),
    'notify_url' => EXAMPLE_URL.'payment-notify.php',
    'trade_type' => 'NATIVE'
);

$cache->set('payment-qrcode-response-success-product-id', $request['product_id']);

$response = new QrcodeResponse($wechat, $options);
$response->send();
