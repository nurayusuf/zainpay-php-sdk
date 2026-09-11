<?php

namespace Zainpay\SDK\Tests\Classes;

use Zainpay\SDK\Response;
use Zainpay\SDK\Tests\Mockery;

class PaymentLink extends \Zainpay\SDK\PaymentLink
{
    public function create(
        string $zainboxCode,
        string $name,
        string $amount,
        ?string $description = null,
        ?string $expiresAt = null,
        ?string $returnUrl = null,
        ?array $metaData = null,
        ?int $maxPaymentCount = null,
        ?bool $collectMobileNumber = null,
        ?bool $collectAddress = null,
        ?string $customPaymentLinkId = null
    ): Response {
        return Mockery::mockResponseFromFile(
            'POST',
            '/',
            dirname(__DIR__) . '/responses/payment-link/create.json'
        );
    }

    public function activate(string $paymentLinkId): Response
    {
        return Mockery::mockResponseFromFile(
            'PATCH',
            '/',
            dirname(__DIR__) . '/responses/payment-link/activate.json'
        );
    }

    public function deactivate(string $paymentLinkId): Response
    {
        return Mockery::mockResponseFromFile(
            'PATCH',
            '/',
            dirname(__DIR__) . '/responses/payment-link/deactivate.json'
        );
    }

    public function validate(string $paymentLinkId): Response
    {
        return Mockery::mockResponseFromFile(
            'GET',
            '/',
            dirname(__DIR__) . '/responses/payment-link/validate.json'
        );
    }

    public function profile(string $paymentLinkId): Response
    {
        return Mockery::mockResponseFromFile(
            'GET',
            '/',
            dirname(__DIR__) . '/responses/payment-link/profile.json'
        );
    }
}
