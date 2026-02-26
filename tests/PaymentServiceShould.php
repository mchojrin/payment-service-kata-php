<?php

use Leewayweb\PaymentServiceKata\FraudService;
use Leewayweb\PaymentServiceKata\PaymentGateway;
use Leewayweb\PaymentServiceKata\PaymentService;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class PaymentServiceShould extends TestCase
{
    #[Test()]
    public function not_send_payment_if_user_is_blacklisted() : void
    {
        $fraudService = $this->createStub(FraudService::class);
        $fraudService
            ->method('isBlacklisted')
            ->willReturn(true)
            ;
        $paymentGateway = $this->createMock(PaymentGateway::class);
        $paymentGateway
            ->expects($this->never())
            ->method('sendPayment')
            ;
        
        $paymentService = new PaymentService($fraudService, $paymentGateway);
        $paymentService->tryToPay("Some user", "Some details");
    }

    #[Test()]
    public function send_payment_if_details_are_not_fraudulent() : void
    {
        $user = "Some user";
        $details = "Some details";

        $fraudService = $this->createStub(FraudService::class);
        $fraudService
            ->method('isBlacklisted')
            ->willReturn(false)
            ;
        $paymentGateway = $this->createMock(PaymentGateway::class);
        $paymentGateway
            ->expects($this->once())
            ->method('sendPayment')
            ->with($details)
        ;
        
        $paymentService = new PaymentService($fraudService, $paymentGateway);
        $paymentService->tryToPay($user, $details);
    }
}