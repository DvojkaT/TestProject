<?php

namespace App\Exceptions;

class WrongRoleHttpException extends BaseHttpException
{
    /**
     * HTTP код ошибки
     *
     * @var int
     */
    protected int $statusCode = 403;

    /**
     * Сообщение об ошибке
     *
     * @var string|null
     */
    protected $message = "Недопустимо для данной роли";
}
