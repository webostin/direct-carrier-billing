<?php


namespace Dcb\Util;


class JsonDecoder
{

    protected $jsonString;

    protected $jsonDeocded;

    protected $assoc = false;

    public function __construct($json)
    {
        $this->jsonString = $json;
    }

    public function removeWhiteSpaces()
    {
        $json = $this->jsonString;
        $json = str_replace(["\n", "\r"], "", $json);
        $json = trim(preg_replace('/\t+/', '', $json));
        $json = preg_replace('/([{,]+)(\s*)([^"]+?)\s*:/', '$1"$3":', $json);
        $json = preg_replace('/(,)\s*}$/', '}', $json);
        return $json;
    }

    public function decode()
    {
        $assoc = $this->assoc;
        $json = $this->removeWhiteSpaces();
        $this->jsonDeocded = json_decode($json, $assoc);
        return $this->jsonDeocded;
    }

    public function setAssoc(bool $assoc)
    {
        $this->assoc = $assoc;
        return $this;
    }
}