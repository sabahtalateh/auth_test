<?php

namespace app\response;

class RedirectResponse implements ResponseInterface
{
    private const CODE = 302;

    private $body = "";

    private $url = "";

    /**
     * RedirectResponse constructor.
     *
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url= $url;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return self::CODE;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}