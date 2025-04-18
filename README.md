Base package for sending SMS by HTTP via service gateways.

## Gateways

- [smsc.ru](https://github.com/ensostudio/sms-smsc)
- [sms.ru](https://github.com/ensostudio/sms-smsru)

## Example

Use [GuzzleHttp](https://github.com/guzzle) to send request:

```php
$gateway = new \EnsoStudio\Sms\Gateway\SmscGateway(
    ['apiKey' => '...'],
    new \GuzzleHttp\Client(),
    new \GuzzleHttp\Psr7\HttpFactory()
);
$result = $gateway->sendSms('Test message', [\EnsoStudio\Sms\PhoneUtils::sanitizeNumber('+7 905 710-71-71')]);
if (!$result->isSuccess()) {
    // error handler for $result->getErrors()
}
```