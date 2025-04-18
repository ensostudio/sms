<?php

namespace EnsoStudio\Sms;

/**
 * The adapter of SMS gateway.
 *
 * @link https://en.wikipedia.org/wiki/SMS_gateway
 * @link https://en.wikipedia.org/wiki/E.164
 */
interface GatewayInterface
{
    /**
     * Returns the short name of gateway.
     */
    public function getName(): string;

    /**
     * Sends message to recipient phones.
     *
     * @param string $message The message to send, string encoded in UTF-8
     * @param string[] $recipientPhones The destination phone numbers in format E.164
     * @see PhoneUtils::sanitizeNumber()
     */
    public function sendSms(string $message, iterable $recipientPhones): ResultInterface;
}
