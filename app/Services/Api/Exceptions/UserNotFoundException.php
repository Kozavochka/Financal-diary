<?php

namespace App\Services\Api\Exceptions;

use App\Exceptions\Api\AbstractApiException;

class UserNotFoundException extends AbstractApiException
{
    public $reason = "user_not_found";
}
