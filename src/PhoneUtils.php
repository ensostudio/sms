<?php

namespace EnsoStudio\Sms;

/**
 * The phone number helper.
 */
class PhoneUtils
{
    /**
     * Returns the sanitized phone number contained only + and digits.
     */
    public static function sanitizeNumber(string $number): string
    {
        return preg_replace('/[^+\d]+/', '', $number);
    }

    /**
     * Checks if is valid the E.164 phone number.
     */
    public static function validateNumber(string $number): bool
    {
        return preg_match('/^\+?\d{10,15}$/', $number) === 1;
    }
}
