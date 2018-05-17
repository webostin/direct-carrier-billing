<?php

namespace Dcb;


use Dcb\Auth\BearerInterface;
use Dcb\Auth\BearerProviderInterface;
use Dcb\Model\BuyerInterface;
use Dcb\Model\ServiceInterface;
use Dcb\Model\TransactionInterface;
use Dcb\Option\OptionableInterface;
use Dcb\Option\OptionInterface;
use Dcb\Request\AnnounceInterface;
use Dcb\Request\SubscribeInterface;

class Dcb
{
    /**
     * @var BearerInterface
     */
    protected $bearer;

    protected $url;

    public function __construct(BearerProviderInterface $bearerProvider, $url)
    {
        $this->bearer = $bearerProvider->getBearer();
        $this->url = $url;
    }

    public function announce(AnnounceInterface $request)
    {
        $data = [
            'id' => $request->getId(),
            'merchantId' => $request->getMerchant()->getId(),
            'redirectTo' => $request->getRedirectTo(),
            'notifyUrl' => $request->getNotifyUrl(),
            'buyer' => [
                'phone' => $request->getBuyer()->getPhone(),
            ],
            'service' => [
                'id' => $request->getService()->getId(),
                'quantity' => $request->getService()->getQuantity(),
                'price' => $request->getService()->getPrice(),
            ],
            'options' => [],
        ];

        $this->addOptions($request, $data);

        return $this->callPost('/api/direct/announce', $data);
    }

    public function subscribe(SubscribeInterface $request)
    {
        $data = [
            'id' => $request->getId(),
            'merchantId' => $request->getMerchant()->getId(),
            'notifyUrl' => $request->getNotifyUrl(),
            'buyer' => [
                'phone' => $request->getBuyer()->getPhone(),
            ],
            'service' => [
                'id' => $request->getService()->getId(),
                'quantity' => $request->getService()->getQuantity(),
                'price' => $request->getService()->getPrice(),
            ],
            'options' => [],
        ];

        $this->addOptions($request, $data);

        return $this->callPost('/api/direct/subscribe', $data);
    }

    public function unsubscribe(ServiceInterface $service, BuyerInterface $buyer)
    {
        $data = [
            'serviceId' => $service->getId(),
            'msisdn' => $buyer->getPhone(),
        ];

        return $this->callPost('/api/directbilling/unsubscribe', $data);
    }

    public function charge(TransactionInterface $transaction)
    {
        $data = [
            'transactionId' => $transaction->getId(),
        ];

        return $this->callPost('/api/direct/charge', $data);
    }

    public function checkOp(BuyerInterface $buyer)
    {
        $action = '/api/direct/checkop/' . $buyer->getPhone();
        return $this->callGet($action);
    }

    public function status(TransactionInterface $transaction)
    {
        return $this->callGet('/api/direct/status/' . $transaction->getId());
    }

    public function confirm(TransactionInterface $transaction, string $token)
    {
        $data = [
            'transactionId' => $transaction->getId(),
            'token' => $token,
        ];

        return $this->callPost('/api/direct/confirm', $data);
    }

    protected function addOptions(OptionableInterface $request, &$data)
    {
        if ($options = $request->getOptions()) {
            foreach ($options as $option) {
                if ($option instanceof OptionInterface) {
                    array_push($data['options'], ['key' => $option->getKey(), 'value' => $option->getValue()]);
                }
            }
        }
    }

    protected function callPost($action, $data)
    {
        $headers = [
            'Authorization' => 'bearer ' . $this->bearer->getToken(),
            'Content-Type' => 'application/json',
        ];

        $curl = new \CurlHelper($this->url . $action);
        $curl->setPostRaw(json_encode($data))
            ->setHeaders($headers);
        return $curl->exec();
    }

    protected function callGet($action)
    {
        $headers = [
            'Authorization' => 'bearer ' . $this->bearer->getToken(),
        ];

        $curl = new \CurlHelper($this->url . $action);
        $curl->setHeaders($headers);

        return $curl->exec();
    }
}