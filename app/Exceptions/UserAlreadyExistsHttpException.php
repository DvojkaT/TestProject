<?php

namespace App\Exceptions;

use Exception;

class UserAlreadyExistsHttpException extends BaseHttpException
{
    /**
     * HTTP код ошибки
     *
     * @var int
     */
    protected int $statusCode = 409;

    /**
     * Сообщение об ошибке
     *
     * @var string|null
     */
    protected $message = "Пользователь с такой почтой уже существует";
}
