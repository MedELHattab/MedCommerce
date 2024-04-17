<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Payment;
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller
{
    public function mollie(Request $request)
    {
        // Calculate the total amount in DHS
        $totalDHS = 0; // Initialize totalDHS
        $productsDescription = ''; // Initialize products description

        if (session('cart')) {
            foreach (session('cart') as $id => $details) {
                $totalDHS += $details['price'] * $details['quantity'];
                
                // Append each product's name and quantity to the description
                $productsDescription .= $details['name'] . ' (' . $details['quantity'] . '), ';
            }
        }

        // Remove the trailing comma and space from the products description
        $productsDescription = rtrim($productsDescription, ', ');

        // Define the exchange rate
        $exchangeRate = 10;

        // Convert total amount to USD
        $totalUSD = number_format($totalDHS / $exchangeRate, 2, '.', '');

        // Ensure the converted amount meets the minimum requirements of Mollie
        $minAmountUSD = 1.00; // Replace with the actual minimum amount required by Mollie

        if ($totalUSD < $minAmountUSD) {
            // If the amount is lower than the minimum, set it to the minimum
            $totalUSD = $minAmountUSD;
        }

        // Format the amount as a string with the correct number of decimals
        $formattedAmount = number_format($totalUSD, 2, '.', '');

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "USD",
                "value" => $formattedAmount,
            ],
            "description" => $productsDescription, // Use the products description
            "redirectUrl" => route('success'),
            // "webhookUrl" => route('webhooks.mollie'),
            "metadata" => [
                "order_id" => time(),
            ],
        ]);

        //dd($payment);

        session()->put('paymentId', $payment->id);
        session()->put('quantity', $request->quantity);
    
        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success(Request $request)
    {
        $paymentId = session()->get('paymentId');
        $payment = Mollie::api()->payments->get($paymentId);
    
        if ($payment->isPaid()) {
            $obj = new Payment();
            $obj->payment_id = $paymentId;
            $obj->product_name = $payment->description;
            $obj->quantity = session()->get('quantity');
            $obj->amount = $payment->amount->value;
            $obj->currency = $payment->amount->currency;
            $obj->payment_status = "Completed";
            $obj->payment_method = "Mollie";
            $obj->user_id = auth()->id();
            $obj->save();
    
            $order = new Order();
            $order->payment_ref = $paymentId;
            
            // Check if the user has made a payment, if not, apply a 10% discount
            $userMadePayment = Order::where('user_id', auth()->id())->exists();
            if (!$userMadePayment) {
                $discount = $payment->amount->value * 0.10;
                $order->total_price = $payment->amount->value - $discount;
            } else {
                $order->total_price = $payment->amount->value;
            }
    
            $order->payment_id = $obj->id;
            $order->user_id = auth()->id();
            $order->save();
    
            session()->forget('paymentId');
            session()->forget('quantity');
    
            echo 'Payment is successful.';
        } else {
            return redirect()->route('cancel');
        }
    }

    public function cancel()
    {
        echo "Payment is cancelled.";
    }
}