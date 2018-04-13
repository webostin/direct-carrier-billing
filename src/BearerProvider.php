<?php


namespace Dcb;


class BearerProvider implements BearerProviderInterface
{

    /**
     * @var BearerInterface
     */
    protected $bearer;

    /**
     * @var CredentialsInterface
     */
    protected $credentials;

    public function __construct(CredentialsInterface $credentials)
    {
        $this->credentials = $credentials;
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