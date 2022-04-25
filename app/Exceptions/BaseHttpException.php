<?php


namespace App\Exceptions;


use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class BaseHttpException
 *
 * Базовый класс для исключений, которые не должны логироваться,
 * но должны выдаваться в ответе
 *
 * @package App\Exceptions
 */
class BaseHttpException extends HttpException
{
    /**
     * HTTP код ошибки
     *
     * @var int
     */
    protected int $statusCode;

    /**
     * Сообщение об ошибке
     *
     * @var string|null
     */
    protected $message;

    /**
     * BaseHttpException constructor.
     *
     * @param string|null $message
     * @param \Throwable|null $previous
     * @param array<mixed> $headers
     * @param int|null $code
     */
    public function __construct(?string $message = null, \Throwable $previous = null, array $headers = [], ?int $code = 0)
    {
        parent::__construct($this->statusCode ?? 500, $message ?: $this->message, $previous, $headers, $code);
    }
}
