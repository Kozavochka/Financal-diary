<?php

namespace App\Services\Api\Exceptions;

use App\Exceptions\Api\AbstractApiException;

class InvalidLoginCodeException extends AbstractApiException
{
    public $reason = "invalid_login_code";
}
