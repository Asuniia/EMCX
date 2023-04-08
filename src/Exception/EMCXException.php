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
        $this->handle();
    }

    public function handle() {
        return die("<h1>EMCX Exception: " . $this->message . " (" . $this->code . ")</h1>");
    }
}
