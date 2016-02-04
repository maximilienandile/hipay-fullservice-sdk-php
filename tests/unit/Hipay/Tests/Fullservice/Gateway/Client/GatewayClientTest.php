<?php
/*
 * Hipay fullservice SDK
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @copyright      Copyright (c) 2016 - Hipay
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 *
 */
namespace Hipay\Tests\Fullservice\Gateway\Client;

use Hipay\Tests\TestCase;
use Hipay\Fullservice\HTTP\Configuration\Configuration;
use Hipay\Fullservice\Gateway\Client\GatewayClient;

/**
 * Client Test class for all request send to TPP Fullservice.
 *
 * @category    Hipay
 * @package     Hipay\Tests
 * @author 		Kassim Belghait <kassim@sirateck.com>
 * @copyright   Copyright (c) 2016 - Hipay
 * @license     http://opensource.org/licenses/mit-license.php MIT License
 * @link 		https://github.com/hipay/hipay-fullservice-sdk-php
 * @api
 */
class GatewayClientTest extends TestCase{
	
	/**
	 * 
	 * @var \Hipay\Fullservice\HTTP\Configuration\ConfigurationInterface|\PHPUnit_Framework_MockObject_MockObject
	 */
	protected $_config;
	
	/**
	 * 
	 * @var \Hipay\Fullservice\HTTP\ClientProvider|\PHPUnit_Framework_MockObject_MockObject $_clientProvider
	 */
	protected $_clientProvider;
	
	/**
	 * 
	 * @var \Hipay\Fullservice\HTTP\Response\abstractResponse|PHPUnit_Framework_MockObject_MockObject
	 */
	protected $_response;
	
	
	
    
    protected function setUp()
    {
    	$this->_config = $this->getMockBuilder('\Hipay\Fullservice\HTTP\Configuration\ConfigurationInterface')
    							->disableOriginalConstructor()
    							->getMock();
    	$this->_clientProvider = $this->getMockBuilder('\Hipay\Fullservice\HTTP\ClientProvider')
    							->setConstructorArgs([$this->_config])
    							->getMock();
    	
		$this->_response = $this->getMockBuilder('\Hipay\Fullservice\HTTP\Response\AbstractResponse')
    							->disableOriginalConstructor()
    							->getMock();
	          
    }
    
    /**
	 * @cover Hipay\Fullservice\Gateway\Client\GatewayClient::__construct
	 */
    public function testCanBeConstructUsingClientProvider(){
    	
    	$gateway = new GatewayClient($this->_clientProvider);
    	
    	$this->assertInstanceOf(GatewayClient::class, $gateway);
    	
    	return $gateway;
    }
    
    /**
     * @cover Hipay\Fullservice\Gateway\Client\GatewayClient::requestrequestHostedPaymentPage
     * @dataProvider requestHostedPaymentPageDataProvider
     * 
     */
    public function testCallRequestHostedPaymentPage($request,$response){
    	
    	$this->_response->method('toArray')->willReturn($response);
    	
    	$this->_clientProvider
    				->method('request')
    				->willReturn($this->_response);
    	
    	
    	$gateway = $this->getMock('\Hipay\Fullservice\Gateway\Client\GatewayClient',['_serializeRequestToArray'],[$this->_clientProvider]) ;//new GatewayClient($this->_clientProvider);
    	$gateway->method('_serializeRequestToArray')->willReturn($request);
    	
    	$hpp = $this->getMock('\Hipay\Fullservice\Gateway\Request\Order\HostedPaymentPageRequest');
    	
    	$model = $gateway->requestHostedPaymentPage($hpp);
    	
    	$this->assertInstanceOf('\Hipay\Fullservice\Gateway\Model\HostedPaymentPage', $model);
    	
    	$this->assertEquals('https://stage-secure-gateway.allopass.com/payment/web/pay/9eb3c963-907a-42af-8bc3-0b30b6149779', $model->getForwardUrl());
    	
    }

    
    public function requestHostedPaymentPageDataProvider()
    {
    	return [
    			[
    					[
    							"orderid" => "200000173",
    							"description" => "Commande 200000173 example@test.com",
    							"long_description" =>"",
    							"currency" => "EUR",
    							"amount" => "165",
    							"shipping" => "5.0000",
    							"tax" => "0.0000",
    							"cid" => "142",
    							"ipaddr" => "",
    							"http_accept" => "*/*",
    							"http_user_agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36",
    							"language" => "fr_FR",
    							"authentication_indicator" => "0",
    							"accept_url" => "http://test.com/payment/accept/",
    							"decline_url" => "http://test.com/payment/decline/",
    							"pending_url" => "http://test.com/payment/pending/",
    							"exception_url" => "http://test.com/payment/exception/",
    							"cancel_url" => "http://test.com/payment/cancel/",
    							"email" => "example@foo.com",
    							"phone" => "0101010101",
    							"gender" => "U",
    							"firstname" => "John",
    							"lastname" => "Doe",
    							"recipientinfo" => "My Company",
    							"streetaddress" => "Business Open Space",
    							"streetaddress2" => "3 all�e Champlain",
    							"city" => "Sevran",
    							"zipcode" => "93270",
    							"country" => "FR",
    							"shipto_firstname" => "John",
    							"shipto_lastname" => "Doe",
    							"shipto_recipientinfo" => "my company",
    							"shipto_streetaddress" => "Business Open Space",
    							"shipto_streetaddress2" => "3 all�e Champlain",
    							"shipto_city" => "Sevran",
    							"shipto_zipcode" => "93270",
    							"shipto_country" => "FR",
    							"cdata1" => "http://test.com/index.php/admin/admin/sales_order/view/order_id/370/",
    							"payment_product" => "cb",
    							"operation" => "Sale",
    							"css" => "",
    							"template" => "basic-js",
    							"display_selector" => "1",
    							"payment_product_list" => "visa,mastercard,maestro",
    							"payment_product_category_list" => "credit-card",
    					],
    					[
						 	"forwardUrl" => "https://stage-secure-gateway.allopass.com/payment/web/pay/9eb3c963-907a-42af-8bc3-0b30b6149779",
						    "test" => true,
						    "mid" => "00001326593",
						    "cdata1" => "http://magento1910.sirateck.com/index.php/admin/admin/sales_order/view/order_id/370/",
						    "cdata2" => "",
						    "cdata3" => "",
						    "cdata4" => "",
						    "cdata5" => "",
						    "cdata6" => "",
						    "cdata7" => "",
						    "cdata8" => "",
						    "cdata9" => "",
						    "cdata10" => "",
						    "order" => [
						            "id" => "200000173",
						            "dateCreated" => "2016-01-12T15:20:43+0000",
						            "attempts" => "0",
						            "amount" => "165.00",
						            "shipping" => "5.00",
						            "tax" => "0.00",
						            "decimals" => "2",
						            "currency" => "EUR",
						            "customerId" => "142",
						            "language" => "fr_FR",
						            "email" => "example@test.com",
						        ]
    							
    						
    					]
    					
    			],
    	];
    }

	
}