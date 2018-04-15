<?php


namespace Dcb;


use Dcb\Exceptions\InvalidCredentialsException;

class BearerProvider implements BearerProviderInterface
{

    /**
     * @var BearerInterface
     */
    protected $bearer;

    protected $expire;

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

    public function isLoggedIn(): bool
    {
        if ($this->bearer instanceof Bearer) {
            if (time() < $this->bearer->getExpires()) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return $this
     * @throws InvalidCredentialsException
     */
    protected function login()
    {
        $curl = new \CurlHelper($this->url . '/api/security/login');
        $curl->setPostFields([
            'login' => $this->credentials->getLogin(),
            'password' => $this->credentials->getPassword(),
        ]);

        $response = $curl->exec();

        if ($response['status'] == 200 AND $response['content']) {
            $jsonResponse = json_decode($response['content']);
            if (isset($jsonResponse->token)) {
                $bearer = new Bearer($jsonResponse->token, $jsonResponse->expires);
                $this->bearer = $bearer;
                return $this;
            }
        }

        throw new InvalidCredentialsException();
    }
}