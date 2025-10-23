<?php

interface PaymentProcessor{
    public function processPayment(float | int $amount): bool;
    public function refundPayment(float | int $amount): bool;
}

abstract class OnlinePaymentProcessor implements PaymentProcessor {
    public function __construct (protected readonly string $apiKey) {

    }

    abstract protected function validateApiKey(): bool;
    abstract protected function executePayment(float | int $amount): bool;
    abstract protected function executeRefund(float | int $amount): bool;

    public function processPayment(float | int $amount): bool {
        if (!$this->validateApiKey()) {
            throw new Exception("Invalid API key");
        }
        return $this->executePayment($amount);
    }

    public function refundPayment(float | int $amount): bool {
        if (!$this->validateApiKey()) {
            throw new Exception("Invalid API key");
        }
        return $this->executeRefund($amount);
    }
}
final class StripeProcessor extends OnlinePaymentProcessor {
    protected function validateApiKey(): bool {
        return str_starts_with($this->apiKey, 'sk_');
    }
    protected function executePayment(float | int $amount): bool {
        echo "Processing Stripe payment of $amount\n";
        return true;
    }

    protected function executeRefund(float | int $amount): bool {
        echo "Processing Stripe refunds of $amount\n";
        return true;
    }
}

class PayPalProcessor extends OnlinePaymentProcessor {
    protected function validateApiKey(): bool {
        return strlen($this->apiKey) === 32;
    }

    protected function executePayment(float | int $amount): bool {
        echo "Processing PayPal payment of $amount\n";
        return true;
    }

    protected function executeRefund(float | int $amount): bool {
        echo "Processing PayPal refunds of $amount\n";
        return true;
    }
}

class CashPaymentProcessor implements PaymentProcessor {
    public function processPayment(float | int $amount): bool {
        echo "Cash payment... $amount\n";
        return true;
    }
    public function refundPayment(float | int $amount): bool {
        echo "Cash refund...  $amount\n";
        return true;
    }
}

class OrderProcessor {
    public function __construct(private PaymentProcessor $paymentProcessor) {
    }

    public function processOrder(float | int $amount, string | array $items): void {
        if (is_array($items)) {
            $itemsList = implode(',', $items);
        } else {
            $itemsList = $items;
        }
        echo "Processing order for items: $itemsList\n";
        if ($this->paymentProcessor->processPayment($amount)) {
            echo "Order processed successfully\n";
        } else {
            echo "Order processing failed\n";
        }
    }

    public function refundOrder(float | int $amount): void {
        if ($this->paymentProcessor->refundPayment($amount)) {
            echo "Order refunded successfully\n";
        } else {
            echo "Order refunded failed\n";
        }
    }
}


$stripeProcessor = new StripeProcessor("sk_test_1A2B3C");
$paypalProcessor = new PayPalProcessor("valid_paypal_api_key_32charslong");
$cashProcessor = new CashPaymentProcessor();

$stripeOrder = new OrderProcessor($stripeProcessor);
$paypalOrder = new OrderProcessor($paypalProcessor);
$cashOrder = new OrderProcessor($cashProcessor);

$stripeOrder->processOrder(100.00, "Book");
$paypalOrder->processOrder(1250.00, ["Book", "Movie"]);
$cashOrder->processOrder(1003.00, ["Book", "Orange"]);

$stripeOrder->refundOrder(24.00);
$paypalOrder->refundOrder(34.00);
$cashOrder->refundOrder(21.00);