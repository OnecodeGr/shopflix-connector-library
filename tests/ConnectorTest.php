<?php
/**
 * ConnectorTest.php
 *
 * @copyright Copyright © 2022 ${ORGANIZATION_NAME}  All rights reserved.
 * @author    Spyros Bodinis {spyros@onecode.gr}
 */

namespace Spyrmp\ShopFlixConnector\Tests;

use Onecode\ShopFlixConnector\Library\Connector;
use PHPUnit\Framework\TestCase;

class ConnectorTest extends TestCase
{


    private $connector;

    public function setUp(): void
    {
        parent::setUp();
        $this->connector = new Connector($_ENV['USERNAME'], $_ENV['PASSWORD'], $_ENV["API_URL"]);
    }

    /**
     * @dataProvider getShipmentIds
     */
    public function testPrintManifest($shipments)
    {

        if ($shipments) {
            $manifest = $this->connector->printManifest($shipments);
            $this->assertArrayHasKey("status", $manifest);
            $this->assertArrayHasKey("manifest", $manifest);
            $this->assertIsArray($manifest);
        } else {
            print "empty shipments array";
        }


    }

    /**
     * @dataProvider getOrderIds
     */
    public function testGetOrderDetail($getOrderIds)
    {

        foreach ($getOrderIds as $orderId) {
            $orderData = $this->connector->getOrderDetail($orderId);

            if ($orderId == 1143) {
                $json = '{"order":{"shopflix_order_id":"1143","increment_id":"1143","state":"pending_acceptance","status":"pending_acceptance","subtotal":2.3,"discount_amount":0,"total_paid":"6.80","customer_email":"spyros+123@onecode.gr","customer_firstname":"test","customer_lastname":"test","customer_remote_ip":"","customer_note":""},"addresses":[{"firstname":"test","lastname":"test","postcode":"16672","telephone":"6972356892","street":"\u0392\u03b1\u03c3\u03b9\u03bb\u03ad\u03c9\u03c2 \u039a\u03c9\u03bd\u03c3\u03c4\u03b1\u03bd\u03c4\u03b9\u03bd\u03bf\u03c5","address_type":"shipping","city":"\u0392\u03ac\u03c1\u03b7","email":"spyros+123@onecode.gr","country_id":"GR"},{"firstname":"test","lastname":"test","postcode":"16672","telephone":"6972356892","street":"\u0392\u03b1\u03c3\u03b9\u03bb\u03ad\u03c9\u03c2 \u039a\u03c9\u03bd\u03c3\u03c4\u03b1\u03bd\u03c4\u03b9\u03bd\u03bf\u03c5","address_type":"billing","city":"\u0392\u03ac\u03c1\u03b7","email":"spyros+123@onecode.gr","country_id":"GR"}],"items":[{"sku":"127682","price":"2.30","qty":"1"}],"is_invoice":true,"invoice":{"company_name":"test","company_address":"\u039b\u0395\u03a9\u03a6\u039f\u03a1\u039f\u03a3 \u0392\u0391\u03a3\u0399\u039b\u0395\u03a9\u03a3 \u039a\u03a9\u039d\u03a3\u03a4\u0391\u039d\u03a4\u0399\u039d\u039f\u03a5 294, \u039a\u039f\u03a1\u03a9\u03a0\u0399, 19441","company_owner":"ONELOGIC \u039c\u039f\u039d\u039f\u03a0\u03a1\u039f\u03a3\u03a9\u03a0\u0397  \u0399\u039a\u0395","company_vat_number":"801082885","tax_office":"\u039a\u039f\u03a1\u03a9\u03a0\u0399\u039f\u03a5"}}';
            }else{
                $json = '{"order":{"shopflix_order_id":"523","increment_id":"523","state":"canceled","status":"canceled","subtotal":11.74,"discount_amount":0,"total_paid":"16.24","customer_email":"n.iliopoulos@wellcomm.gr","customer_firstname":"Nikos","customer_lastname":"Iliopoulos","customer_remote_ip":"","customer_note":null},"addresses":[{"firstname":"Nikos","lastname":"Iliopoulos","postcode":"10447","telephone":"6974386413","street":"\u039b\u03b5\u03c9\u03c6\u03cc\u03c1\u03bf\u03c2 \u0391\u03b8\u03b7\u03bd\u03ce\u03bd","address_type":"shipping","city":"\u0391\u03b8\u03ae\u03bd\u03b1","email":"n.iliopoulos@wellcomm.gr","country_id":"GR"},{"firstname":"Nikos","lastname":"Iliopoulos","postcode":"10447","telephone":"6974386413","street":"\u039b\u03b5\u03c9\u03c6\u03cc\u03c1\u03bf\u03c2 \u0391\u03b8\u03b7\u03bd\u03ce\u03bd","address_type":"billing","city":"\u0391\u03b8\u03ae\u03bd\u03b1","email":"n.iliopoulos@wellcomm.gr","country_id":"GR"}],"items":[{"sku":"112170","price":"11.74","qty":"1"}],"is_invoice":false}';

            }
            $this->assertArrayHasKey("is_invoice", $orderData);
            $this->assertJsonStringEqualsJsonString(
                $json,
            json_encode($orderData));

        }


    }


    public function getOrderIds(): iterable
    {
        yield [
            [1143, 523]
        ];
    }

    public function getShipmentIds(): iterable
    {
        yield [
            [157]
        ];
    }
}
