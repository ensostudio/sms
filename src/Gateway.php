<?php

namespace EnsoStudio\Sms;

use InvalidArgumentException;

/**
 * Abstract SMS gateway.
 */
abstract class Gateway implements GatewayInterface
{
    /**
     * Creates new instance.
     *
     * @param iterable $settings The gateway settings as name/value pairs
     */
    public function __construct(iterable $settings)
    {
        $this->setSettings($settings);
    }

    /**
     * Fills the gateway properties via setters or directly.
     *
     * @return $this
     * @throws InvalidArgumentException Unknown setting
     */
    public function setSettings(iterable $settings): self
    {
        foreach ($settings as $key => $value) {
            $method = 'set' . $key;
            if (method_exists($this, $method)) {
                $this->{$method}($value);
            } elseif (property_exists($this, $key)) {
                $this->{$key} = $value;
            } else {
                throw new InvalidArgumentException('Unknown setting: ' . $key);
            }
        }

        return $this;
    }
}
