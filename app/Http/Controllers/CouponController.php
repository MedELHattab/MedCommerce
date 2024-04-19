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
        ]);



        $coupon = $this->couponService->create($data);

        return redirect()->back()->with('success', 'Coupon posted successfully.');
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
        ]);
    
        $coupon = $this->couponService->update($data, $coupon->id); // Fixed update call
    
        return redirect()->route('coupons');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $this->couponService->delete($id); 

        return redirect()->back();
    }
}
