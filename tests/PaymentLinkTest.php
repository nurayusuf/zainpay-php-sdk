<?php

namespace Zainpay\SDK\Tests;

use GuzzleHttp\Exception\GuzzleException;
use Zainpay\SDK\Tests\Classes\PaymentLink;


class PaymentLinkTest extends TestCase
{
    protected function setUp(): void
    {
        TestableEngine::useDummyToken();
        parent::setUp();
    }

    /**
     * @throws GuzzleException
     */
    public function testCreate(): void
    {
        $response = PaymentLink::instantiate()->create(
            "STORE_Xy9Kp2mNqRtVwZ1sL",
            "Dubai Abayas",
            "150000",
            "These are new arrivals from Dubai",
            "2027-06-01T09:00:00",
            "https://example.com/return/payment",
            ["orderId" => 123],
            10,
            true,
            false,
            "dubai-abayas-2027"
        );
        self::assertTrue($response->hasSucceeded());
    }

    /**
     * @throws GuzzleException
     */
    public function testActivate(): void
    {
        $response = PaymentLink::instantiate()->activate("V1StGXR8_Z5jdHi6B");
        self::assertTrue($response->hasSucceeded());
    }

    /**
     * @throws GuzzleException
     */
    public function testDeactivate(): void
    {
        $response = PaymentLink::instantiate()->deactivate("V1StGXR8_Z5jdHi6B");
        self::assertTrue($response->hasSucceeded());
    }

    /**
     * @throws GuzzleException
     */
    public function testValidate(): void
    {
        $response = PaymentLink::instantiate()->validate("V1StGXR8_Z5jdHi6B");
        self::assertTrue($response->hasSucceeded());
    }

    /**
     * @throws GuzzleException
     */
    public function testProfile(): void
    {
        $response = PaymentLink::instantiate()->profile("V1StGXR8_Z5jdHi6B");
        self::assertTrue($response->hasSucceeded());
    }
}
