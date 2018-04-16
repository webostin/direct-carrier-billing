<?php


namespace Tests;


use Dcb\Auth\BearerProviderInterface;
use Dcb\Dcb;
use Dcb\Model\BuyerInterface;
use Dcb\Model\ServiceInterface;
use Dcb\Model\TransactionInterface;
use Dcb\Request\AnnounceInterface;
use Dcb\Request\SubscribeInterface;
use Dcb\Util\JsonDecoder;

class DcbTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Dcb\\Dcb'));
    }

    public function testAnnounce()
    {
        $request = $this->createMock(AnnounceInterface::class);
        $bearerProvider = $this->createMock(BearerProviderInterface::class);

        $dcb = new Dcb($bearerProvider, 'https://private-anon-e07fa5d4cc-epaymentdirect.apiary-mock.com');

        $response = $dcb->announce($request);

        $this->assertNotEmpty($response);
        $content = (string)$response['content'];

        $this->assertNotEmpty($content);
        $this->assertContains('transactionId', $content);
        $this->assertContains('status', $content);
        $this->assertContains('carrier', $content);
        $this->assertContains('service', $content);
    }

    public function testSubscribe()
    {
        $request = $this->createMock(SubscribeInterface::class);
        $bearerProvider = $this->createMock(BearerProviderInterface::class);

        $dcb = new Dcb($bearerProvider, 'https://private-anon-e07fa5d4cc-epaymentdirect.apiary-mock.com');

        $response = $dcb->subscribe($request);

        $this->assertNotEmpty($response);
        $content = (string)$response['content'];

        $this->assertNotEmpty($content);
        $this->assertContains('transactionId', $content);
        $this->assertContains('status', $content);
        $this->assertContains('carrier', $content);
        $this->assertContains('service', $content);
    }

    public function testCharge()
    {
        $transaction = $this->createMock(TransactionInterface::class);
        $bearerProvider = $this->createMock(BearerProviderInterface::class);

        $dcb = new Dcb($bearerProvider, 'https://private-anon-e07fa5d4cc-epaymentdirect.apiary-mock.com');

        $response = $dcb->charge($transaction);

        $this->assertNotEmpty($response);
        $content = (string)$response['content'];

        $this->assertNotEmpty($content);
        $this->assertContains('transactionId', $content);
    }

    public function testConfirm()
    {
        $transaction = $this->createMock(TransactionInterface::class);
        $token = md5(rand());
        $bearerProvider = $this->createMock(BearerProviderInterface::class);

        $dcb = new Dcb($bearerProvider, 'https://private-anon-e07fa5d4cc-epaymentdirect.apiary-mock.com');

        $response = $dcb->confirm($transaction, $token);

        $this->assertNotEmpty($response);
        $content = (string)$response['content'];

        $this->assertNotEmpty($content);
        $this->assertContains('transactionId', $content);
    }

    public function testStatus()
    {
        $transaction = new class implements TransactionInterface
        {
            public function getId(): string
            {
                return 'asds-asdasd-asd';
            }

        };
        $bearerProvider = $this->createMock(BearerProviderInterface::class);

        $dcb = new Dcb($bearerProvider, 'https://private-anon-e07fa5d4cc-epaymentdirect.apiary-mock.com');

        $response = $dcb->status($transaction);

        $this->assertNotEmpty($response);
        $content = (string)$response['content'];

        $this->assertNotEmpty($content);
        $this->assertContains('status', $content);
    }


    public function testCheckOp()
    {
        $buyer = new class implements BuyerInterface
        {
            public function getPhone(): string
            {
                return '666666666';
            }
        };
        $bearerProvider = $this->createMock(BearerProviderInterface::class);

        $dcb = new Dcb($bearerProvider, 'https://private-anon-e07fa5d4cc-epaymentdirect.apiary-mock.com');

        $response = $dcb->checkOp($buyer);

        $this->assertNotEmpty($response);
        $content = (string)$response['content'];

        $this->assertNotEmpty($content);
        $this->assertContains('msisdn', $content);
        $this->assertContains('mnemonic', $content);
        $this->assertContains('carrier', $content);
        $this->assertContains('prepaid', $content);
    }

    public function testUnsubscribe()
    {
        $buyer = $this->createMock(BuyerInterface::class);
        $service = $this->createMock(ServiceInterface::class);
        $bearerProvider = $this->createMock(BearerProviderInterface::class);

        $dcb = new Dcb($bearerProvider, 'https://private-anon-e07fa5d4cc-epaymentdirect.apiary-mock.com');

        $response = $dcb->unsubscribe($service, $buyer);

        $this->assertNotEmpty($response);
        $content = (string)$response['content'];

        $this->assertNotEmpty($content);
        $this->assertContains('status', $content);
        $this->assertContains('message', $content);
    }
}