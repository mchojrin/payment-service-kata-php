<?php

namespace Leewayweb\PaymentServiceKata;
use Leewayweb\PaymentServiceKata\FraudService;
use Leewayweb\PaymentServiceKata\PaymentGateway;

use Exception;

class PaymentService
{
    public function __construct(private FraudService $fraudService, private PaymentGateway $paymentGateway) {}
    public function tryToPay(string $user, string $details): void
    {
        if (!$this->fraudService->isBlacklisted($user)) {
            $this->paymentGateway->sendPayment($details);
        }
    }
}