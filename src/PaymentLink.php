<?php

namespace Zainpay\SDK;

use GuzzleHttp\Exception\GuzzleException;
use Zainpay\SDK\Lib\RequestTrait;

class PaymentLink
{
    use RequestTrait;

    /**
     * Creates a payment link for a merchant zainbox.
     *
     * @param string $zainboxCode
     * @param string $name
     * @param string $amount
     * @param string|null $description
     * @param string|null $expiresAt
     * @param string|null $returnUrl
     * @param array|null $metaData
     * @param int|null $maxPaymentCount
     * @param bool|null $collectMobileNumber
     * @param bool|null $collectAddress
     * @param string|null $customPaymentLinkId
     * @return Response
     * @throws GuzzleException
     */
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
        $payload = [
            'zainboxCode' => $zainboxCode,
            'name' => $name,
            'amount' => $amount,
        ];

        (isset($description)) ? $payload['description'] = $description : null;
        (isset($expiresAt)) ? $payload['expiresAt'] = $expiresAt : null;
        (isset($returnUrl)) ? $payload['returnUrl'] = $returnUrl : null;
        (isset($metaData)) ? $payload['metaData'] = $metaData : null;
        (isset($maxPaymentCount)) ? $payload['maxPaymentCount'] = $maxPaymentCount : null;
        (isset($collectMobileNumber)) ? $payload['collectMobileNumber'] = $collectMobileNumber : null;
        (isset($collectAddress)) ? $payload['collectAddress'] = $collectAddress : null;
        (isset($customPaymentLinkId)) ? $payload['customPaymentLinkId'] = $customPaymentLinkId : null;

        return $this->post($this->getModeUrl() . 'payment-links/create', $payload);
    }

    /**
     * Activates a previously deactivated payment link.
     *
     * @param string $paymentLinkId
     * @return Response
     * @throws GuzzleException
     */
    public function activate(string $paymentLinkId): Response
    {
        return $this->patch($this->getModeUrl() . 'payment-links/' . $paymentLinkId . '/activate', []);
    }

    /**
     * Deactivates a payment link. Once deactivated, the link can no longer be used to initiate payments.
     *
     * @param string $paymentLinkId
     * @return Response
     * @throws GuzzleException
     */
    public function deactivate(string $paymentLinkId): Response
    {
        return $this->patch($this->getModeUrl() . 'payment-links/' . $paymentLinkId . '/deactivate', []);
    }

    /**
     * Public endpoint used by the payment frontend to validate a link and obtain the InlineJS token.
     * Returns 404 if the link does not exist, has expired, or has been deactivated.
     *
     * @param string $paymentLinkId
     * @return Response
     * @throws GuzzleException
     */
    public function validate(string $paymentLinkId): Response
    {
        return $this->getWithoutAuth($this->getModeUrl() . 'payment-links/validate/' . $paymentLinkId);
    }

    /**
     * Returns the full profile and statistics for a payment link.
     * Returns 404 if the link does not exist, has expired, or has been deactivated.
     *
     * @param string $paymentLinkId
     * @return Response
     * @throws GuzzleException
     */
    public function profile(string $paymentLinkId): Response
    {
        return $this->getWithoutAuth($this->getModeUrl() . 'payment-links/' . $paymentLinkId);
    }
}
