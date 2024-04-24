<?php

namespace App\Http\Controllers;


use App\Models\Coupon;
use Illuminate\Http\Request;

use App\Services\CouponService;

class CouponController extends Controller
{

    public function __construct(
        protected CouponService $couponService
    ) {
    }

    public function index()
    {
        $coupons = $this->couponService->all();
        return view('coupons.index', compact('coupons'));
    }



    public function create()
    {
        return view('coupons.create');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'code' => 'required',
            'usage_limit' => 'required',
            'percentage_discount' => 'required',
            'expires_at' => 'required',
        ]);



        $coupon = $this->couponService->create($data);

        return redirect()->route('coupons')->with('success', 'Coupon creatrd successfully.');
    }


    public function edit($id)
    {
        $coupon = $this->couponService->find($id);
        return view('coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $data = $request->validate([
            'code' => 'required',
            'usage_limit' => 'required',
            'percentage_discount' => 'required',
            'expires_at' => 'required',
        ]);

        $coupon = $this->couponService->update($data, $coupon->id); // Fixed update call

        return redirect()->route('coupons')->with('success', 'Coupon updated successfully.');
        ;
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->couponService->delete($id);

        return redirect()->back()->with('success', 'Coupon deleted successfully.');
    }


    public function Applycoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string', 
            'total_price'=>'required|numeric' // Make sure total_price is numeric
        ]);
    
        $code = $request->input('code');
        $totalPrice = (float) $request->input('total_price');
        $coupon = Coupon::where('code', $code)->first();
    
        if (!$coupon) {
            return redirect()->back()->with('error', 'Invalid coupon code.');
        }
    
        // Check if the coupon is expired
        if ($coupon->expires_at <= now()) {
            return redirect()->back()->with('error', 'This coupon has expired.');
        }
    
        $user = auth()->user();
    
        // Check if the user has already used this coupon
        if ($user->coupons()->where('coupon_id', $coupon->id)->exists()) {
            return redirect()->back()->with('error', 'You have already used this coupon.');
        }
    
        // Check if the coupon has reached its usage limit
        if ($coupon->usage_limit == null) {
            return redirect()->back()->with('error', 'This coupon has reached its usage limit.');
        }
    
        // Calculate discount amount based on percentage discount
        $percentageDiscount = $coupon->percentage_discount / 100; 
        $discountAmount = $totalPrice * $percentageDiscount;
       
        $totalPrice -= $discountAmount; 
    
        $user->coupons()->attach($coupon);
    
        $coupon->decrement('usage_limit');
    
        // Store updated total price in session
        session(['totalPrice' => $totalPrice]);

        session(['couponUsed' => true]);
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Coupon applied successfully.');
    }
    
}
