<?php


namespace Dcb;


class BearerProvider implements BearerProviderInterface
{

    /**
     * @var BearerInterface
     */
    protected $bearer;

    protected $url;

    /**
     * @var CredentialsInterface
     */
    protected $credentials;

    public function __construct(CredentialsInterface $credentials, $url)
    {
        $this->credentials = $credentials;
        $this->url = $url;
    }

    public function getBearer(): BearerInterface
    {
        return $this->bearer;
    }

    protected function login()
    {
        // curl for login
    }
}