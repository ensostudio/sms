<?php

namespace EnsoStudio\Sms;

/**
 * The sending result.
 */
interface ResultInterface
{
    public const STATUS_OK = 200;
    public const STATUS_BAD_REQUEST = 400;
    public const STATUS_UNAUTHORIZED = 401;
    public const STATUS_PAYMENT_REQUIRED = 402;
    public const STATUS_TOO_MANY_REQUESTS = 429;
    public const STATUS_GATEWAY_ERROR = 500;

    /**
     * @var string[] An array of response statuses as code/status pairs
     */
    public const STATUSES = [
        self::STATUS_OK => 'OK',
        self::STATUS_BAD_REQUEST => 'Bad request',
        self::STATUS_UNAUTHORIZED => 'Unauthorized',
        self::STATUS_PAYMENT_REQUIRED => 'Payment required',
        self::STATUS_TOO_MANY_REQUESTS => 'Too many requests',
        self::STATUS_GATEWAY_ERROR => 'Gateway error',
    ];

    /**
     * Returns total status of sending.
     */
    public function isSuccess(): bool;

    /**
     * Returns sending errors.
     *
     * This method MUST returns errors as array of recipient phone/status code pairs.
     *
     * @return int[]
     */
    public function getErrors(): array;
}
