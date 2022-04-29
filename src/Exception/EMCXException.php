<?php

namespace App\EMCX\src\Exception;

class EMCXException
{
    protected $message = "No message";
    protected $code = "NO_CODE_EXCEPTION";

    public function __construct(string $message, string $code)
    {
        $this->message = $message;
        $this->code = $code;

        return die(json_encode([
            "errors" => [
                "message" => $this->message,
                "code" => $this->code
            ]
        ]));
    }
}
