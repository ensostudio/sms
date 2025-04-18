<?php

namespace EnsoStudio\Sms;

use PHPUnit\Framework\TestCase;

class PhoneUtilsTest extends TestCase
{
    public function testSanitizeNumber()
    {
        $this->assertEquals('+79267107171', PhoneUtils::sanitizeNumber('+7 (926) 71-071-71'));
        $this->assertEquals('89267107273', PhoneUtils::sanitizeNumber('8 (926) 71-072-73'));
        $this->assertEquals('89267106151', PhoneUtils::sanitizeNumber('89267106151'));
    }

    public function testValidateNumber()
    {
        $this->assertTrue(PhoneUtils::validateNumber('+79267107171'));
        $this->assertTrue(PhoneUtils::validateNumber('89267107171'));
        $this->assertFalse(PhoneUtils::validateNumber('+7 (926) 71-071-71'));
        $this->assertFalse(PhoneUtils::validateNumber('8 (926) 71-072-73'));
    }
}
