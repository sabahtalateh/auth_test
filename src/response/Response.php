<?php

namespace app\response;

class Response implements ResponseInterface
{
    private const CODE = 200;

    private $body = "";

    /**
     * Response constructor.
     *
     * @param string $body
     */
    public function __construct(string $body)
    {
        $this->body = $body;
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
}