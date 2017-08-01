# 微信 SDK

微信公众平台第三方 SDK，简单、优雅、健壮，遵循 psr4 自动加载标准！

## 安装

```php
composer require thenbsp/wechat
```

## 文档

``/documentation`` 目录

## 示例

``/example`` 目录

## 功能

- 基础对象
    - [Cache](/documentation/cache.md)
    - [Wechat](/documentation/wechat.md)
    - [AccessToken](/documentation/accesstoken.md)
    - [Ticket](/documentation/ticket.md)
- JSAPI
    - [生成 JSSDk 配置](/documentation/jssdk.md)
- 微信服务器 IP
    - [获取微信服务器 IP](/documentation/serverip.md)
- 网页授权
    - [OAuth 获取用户信息](/documentation/oauth.md)
    - [AccessToken 对象](/documentation/oauth-accesstoken.md)
    - [User 对象](/documentation/oauth-user.md)
- 微信支付
    - [统一下单](/documentation/payment-unifiedorder.md)
    - [JSAPI chooseWXPay](/documentation/payment-choosewxpay.md)
    - [JSAPI BrandWCPayRequest](/documentation/payment-brandwcpayrequest.md)
    - [扫码支付 模式一](/documentation/payment-qrcode-forever.md)
    - [扫码支付 模式二](/documentation/payment-qrcode-temporary.md)
    - [扫码支付 响应订单（模式二）](/documentation/payment-qrcode-response.md)
    - [支付通知](/documentation/payment-notify.md)
    - [共享收货地址](/documentation/payment-address.md)
    - [现金红包](/documentation/payment-coupon-cash.md)
- 自定义菜单
    - [创建菜单](/documentation/menu-create.md)
    - [查询菜单](/documentation/menu-query.md)
    - [删除菜单](/documentation/menu-delete.md)

- 消息管理
    - [消息实体](/documentation/message-entity.md)
    - [消息事件](/documentation/message-event.md)
    - [模板消息](/documentation/message-template.md)

_其它功能开发中，表着急 ..._