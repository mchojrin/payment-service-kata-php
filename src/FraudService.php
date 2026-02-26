<?php

namespace Leewayweb\PaymentServiceKata;

use Exception;

class FraudService
{
    public function isBlacklisted(string $user): bool
    {
        throw new Exception(__METHOD__." shouldn't be used in a test");
    }
}