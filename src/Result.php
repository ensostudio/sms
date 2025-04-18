<?php

namespace EnsoStudio\Sms;

use InvalidArgumentException;

class Result implements ResultInterface
{
    private array $errors;

    public function __construct(iterable $errors = [])
    {
        $this->setErrors($errors);
    }

    public function isSuccess(): bool
    {
        return empty($this->getErrors());
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param int[] $errors The list of recipient phone/status code pairs
     * @return $this
     */
    public function setErrors(iterable $errors): self
    {
        $this->errors = [];
        foreach ($errors as $recipientPhone => $statusCode) {
            $this->addError($recipientPhone, $statusCode);
        }

        return $this;
    }

    /**
     * @throws InvalidArgumentException Invalid status code
     * @return $this
     */
    public function addError(string $recipientPhone, int $statusCode): self
    {
        if (!isset(static::STATUSES[$statusCode])) {
            throw new InvalidArgumentException('Invalid status code: ' . $statusCode);
        }

        $this->errors[$recipientPhone] = $statusCode;

        return $this;
    }
}
