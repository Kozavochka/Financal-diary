<?php

namespace App\Services\Api\Exceptions;

use App\Exceptions\Api\AbstractApiException;

class TooManyAttemptsException extends AbstractApiException
{
    public $reason = "too_many_attempts";
}
