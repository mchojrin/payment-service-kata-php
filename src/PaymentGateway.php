<?php

namespace Leewayweb\PaymentServiceKata;

class PaymentGateway
{
    public function sendPayment(string $details): void
    {
        throw new \Exception(__METHOD__." shouldn't be used in a test");
    }
}