<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Payment;
use Mollie\Laravel\Facades\Mollie;

use App\Models\Detail;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class MollieController extends Controller
{
    public function mollie(Request $request)
{
    // dd($request);
    $formattedAmount =  $request->totalPrice ;
    // dd($formattedAmount);
    $formattedAmount = number_format($formattedAmount, 2, '.', '');
    // $formattedAmount=sprintf("%.2f",$formattedAmount);
    // $formattedAmount+= 0;
    // dd($formattedAmount);
    $productsDescription = ''; 

    if (session('cart')) {
        foreach (session('cart') as $id => $details) {
            $productsDescription .= $details['name'] . ' - Size: ' . $details['size'] . ' - Color: ' . $details['color'] . ' (' . $details['quantity'] . '), ';        }
    }
    $totalQuantity = 0;

    if (session('cart')) {
        foreach (session('cart') as $id => $details) {
            $totalQuantity += $details['quantity'];
        }
    }

    $productsDescription = rtrim($productsDescription, ', ');
    
    // dd($totalQuantity);
    
    $payment = Mollie::api()->payments->create([
        "amount" => [
            "currency" => "USD",
            "value" => $formattedAmount,
        ],
        "description" => $productsDescription, // Use the products description
        "redirectUrl" => route('success'),
        "metadata" => [
            "order_id" => time(),
        ],
    ]);

    session()->put('paymentId', $payment->id);
    session()->put('quantity', $totalQuantity);

    // Redirect customer to Mollie checkout page
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

            
            
            // // Check if the user has made a payment, if not, apply a 10% discount
            // $userMadePayment = Order::where('user_id', auth()->id())->exists();
            // if (!$userMadePayment) {
            //     $discount = $payment->amount->value * 0.10;
            //     $order->total_price = $payment->amount->value - $discount;
            // } else {
            //     $order->total_price = $payment->amount->value;
            // }

           
            if (session('cart')) {
                foreach (session('cart') as $id => $details) {
                    $size=Size::where("name", $details['size'])->first();
                    $color=Color::where("name", $details['color'])->first();
                    
                    Detail::where('product_id', $details['id'])
                          ->where('size_id', $size->id)
                          ->where('color_id', $color->id)
                          ->update(['number' => DB::raw('number - ' . $details['quantity'])]);
                }
            }
    
            
    
            session()->forget('paymentId');
            session()->forget('quantity');
    
            return redirect()->route('home')->with('success', 'Payement made to cart successfully.');
        } else {
            return redirect()->route('cancel');
        }
    }

    public function cancel()
    {
        echo "Payment is cancelled.";
    }


    public function myPayments(){
        $user = Auth::user();
        $payments = Payment::where('user_id',$user->id)
        ->get();
        // dd($payments);
        return view('payments', compact('payments'));
    }
}