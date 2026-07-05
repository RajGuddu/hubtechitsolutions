<?php

namespace App\Traits;
require_once APPPATH . 'ThirdParty/Razorpay/Razorpay.php';
use Razorpay\Api\Api;
trait RazorpayTrait
{
    public function makePayment($razorConfig)
    {
        define('RAZORPAY_KEY_ID', getenv('RAZORPAY_KEY_ID')); 
        define('RAZORPAY_KEY_SECRET', getenv('RAZORPAY_KEY_SECRET')); 
        $amount = $razorConfig['orderData']['amount'];
        $customer_name = $razorConfig['customer_name'];
        $customer_email = $razorConfig['customer_email'];
        $customer_phone = $razorConfig['customer_phone'];
        $verify_url = $razorConfig['verify_url'];
        $orderData = $razorConfig['orderData'];
        
        $api = new Api(RAZORPAY_KEY_ID, RAZORPAY_KEY_SECRET);
        $razorpayOrder = $api->order->create($orderData);
        $razorpay_order_id = $razorpayOrder['id'];
        

        echo '<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <form id="razorpay-form" method="POST" action="'.$verify_url.'">
                '.csrf_field().'
                <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                <input type="hidden" name="razorpay_signature" id="razorpay_signature">
            </form>
            <script>
            var options = {
                "key": "'.RAZORPAY_KEY_ID.'", // Razorpay key ID
                "amount": "'.$amount.'", // Amount in paise = ₹500.00
                "currency": "INR",
                "name": "HT Solutions",
                "description": "Card Payment",
                "image": "https://hubtechitsolutions.in/public/assets/images/logo/logo-dark.png",
                "order_id": "'.$razorpay_order_id.'", // Created in backend
                "handler": function (response){
                    document.getElementById("razorpay_payment_id").value = response.razorpay_payment_id;
                    document.getElementById("razorpay_order_id").value = response.razorpay_order_id;
                    document.getElementById("razorpay_signature").value = response.razorpay_signature;
                    document.getElementById("razorpay-form").submit();
                },
                "prefill": {
                    "name": "'.$customer_name.'",
                    "email": "'.$customer_email.'",
                    "contact": "'.$customer_phone.'"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
            </script>
        ';
    }

    public function verifyPayment($post){
        define('RAZORPAY_KEY_ID', getenv('RAZORPAY_KEY_ID')); 
        define('RAZORPAY_KEY_SECRET', getenv('RAZORPAY_KEY_SECRET')); 
        $paymentId = $post['razorpay_payment_id'];
        $orderId   = $post['razorpay_order_id'];
        $signature = $post['razorpay_signature'];

        $api = new Api(RAZORPAY_KEY_ID, RAZORPAY_KEY_SECRET);

        $generated_signature = hash_hmac('sha256', $orderId . "|" . $paymentId, RAZORPAY_KEY_SECRET);

        if ($generated_signature === $signature) {
            $payment = $api->payment->fetch($paymentId);

            return [
                'success' => true,
                'paymentId' => $paymentId,
                'orderId' => $orderId,
                // 'user_id' => $payment['notes']['user_id'] ?? 'N/A',
                'te_id' => $payment['notes']['te_id'] ?? 'N/A',
                'amount' => $payment['notes']['amount'] ?? 'N/A',
                'payFrom' => $payment['notes']['payFrom'] ?? 'N/A',
            ];
            
        } else {
            return [
                'success' => false
            ];
        }
    }
}
