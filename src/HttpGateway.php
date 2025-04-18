<?php

namespace EnsoStudio\Sms;

use InvalidArgumentException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Sends the SMS by HTTP request.
 */
abstract class HttpGateway extends Gateway
{
    /**
     * @var ClientInterface The client to sending HTTP requests
     */
    private ClientInterface $httpClient;
    /**
     * @var RequestFactoryInterface The factory of HTTP requests
     */
    private RequestFactoryInterface $httpRequestFactory;

    /**
     * Creates new instance.
     *
     * @param iterable $settings The gateway/request settings as name/value pairs
     * @param ClientInterface $httpClient The client to sending HTTP request
     * @param RequestFactoryInterface $httpRequestFactory The factory of HTTP requests
     */
    public function __construct(
        iterable $settings,
        ClientInterface $httpClient,
        RequestFactoryInterface $httpRequestFactory
    )
    {
        parent::__construct($settings);
        $this->setHttpClient($httpClient);
        $this->setHttpRequestFactory($httpRequestFactory);
    }

    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    public function setHttpClient(ClientInterface $client): self
    {
        $this->httpClient = $client;

        return $this;
    }

    public function getHttpRequestFactory(): RequestFactoryInterface
    {
        return $this->httpRequestFactory;
    }

    public function setHttpRequestFactory(RequestFactoryInterface $requestFactory): self
    {
        $this->httpRequestFactory = $requestFactory;

        return $this;
    }

    /**
     * @inheritDoc
     * @throws InvalidArgumentException Empty list of recipient phones
     * @throws \Psr\Http\Client\ClientExceptionInterface If an error happens while processing the request
     */
    public function sendSms(string $message, iterable $recipientPhones): ResultInterface
    {
        if (!is_array($recipientPhones)) {
            $recipientPhones = iterator_to_array($recipientPhones, false);
        }
        if (empty($recipientPhones)) {
            throw new InvalidArgumentException('Empty list of recipient phones');
        }

        $request = $this->createHttpRequest($message, $recipientPhones);
        $response = $this->getHttpClient()->sendRequest($request);

        return $this->createResult($response);
    }

    /**
     * Returns the gateway URI to send request.
     */
    abstract protected function getUri(): string;

    /**
     * Returns the configured request to gateway.
     *
     * @param string $message The message to send, string encoded in UTF-8
     * @param string[] $recipientPhones The destination phone numbers in format E.164
     */
    abstract protected function createHttpRequest(string $message, array $recipientPhones): RequestInterface;

    /**
     * Returns the sending result.
     */
    abstract protected function createResult(ResponseInterface $httpResponse): ResultInterface;
}
