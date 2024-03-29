# onecode/shopflix_connector_library

[![GitHub version](https://badge.fury.io/gh/OnecodeGr%2Fshopflix-connector-library.svg)](https://badge.fury.io/gh/OnecodeGr%2Fshopflix-connector-library)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](./LICENSE.md)
[![PHP Version Require](http://poser.pugx.org/onecode/shopflix-connector-library/require/php)](https://packagist.org/packages/onecode/shopflix-connector-library)

Library to connect with Shopflix (https://shopflix.gr) for vendors

For >= Php7.1 <= Php7.2 use the php71_php72 branch. Via composer

``composer require onecode/shopflix-connector-library:0.0.1``

For >= php7.3 use the main branch. Via composer

``composer require onecode/shopflix-connector-library``

# Usage

```php
use \Onecode\ShopFlixConnector\Library\Connector;
$connector = new Connector("username", "appi_key", "api_url");
```

Get new orders

```php
$newOrders = $connector->getNewOrders();
```

Get canceled orders

```php
$canceledOrders = $connector->getCancelOrders();
```

Get partial shipped orders

```php
$partialShipped = $connector->getPartialShipped();
```

Get shipped order

```php
$shipped = $connector->getShipped();
```

Update order to shopflix set status to picking mode use on acceptance.

```php
 $order = 123;#Shopflix Order id
 $connector->picking($orderId);
```

Reject order

```php
 $order = 123;#Shopflix Order id
 $connector->reject($orderId, "The product has been removed");
```

Get shipment for specific order

```php
 $order = 123;#Shopflix Order id
 $shipments =  $connector->getShipment($orderId);
```

Create tracking voucher

```php
 $shipmentId = 123;#Shopflix Shipment id
 $voucher = $connector->createVoucher($shipmentId);
```

Print tracking voucher number

```php
 $trackingVoucher = "tracking_voucher";
 $voucher = $connector->printVoucher($trackingVoucher); 
```

Mass print tracking voucher.Max 20 vouchers

```php
 $trackingVouchers = [
     "tracking_voucher1",
     "tracking_voucher2",
     "tracking_voucher3",
     ...
     "tracking_voucher19",
 ];
 $voucher = $connector->printVouchers($trackingVoucher); 
```

Get tracking voucher number from specific shipment

```php
 $shipmentId = 123;#Shopflix Shipment id
 $voucher = $connector->getVoucher($shipmentId); 
```
