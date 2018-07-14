<?php

namespace app\response;

interface ResponseInterface
{
    /**
     * @return int
     */
    public function getCode(): int;

    /**
     * @return string
     */
    public function getBody(): string;
}