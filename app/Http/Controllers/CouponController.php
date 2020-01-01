<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('sweet.coupon_list',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sweet.coupon_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'label'         => 'required|max:255',
            'discount'      => 'required',
            'starts'        => 'required|date', 
            'ends'          => 'required|date',
            'limit'         => 'required', 
            'code'          => 'required',    
        );

        // Validamos todos los campos
        $validator = Validator::make($request->all(), $rules);

        // Si la validación falla, nos detenemos y mandamos false
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $coupon                 = new Coupon;
        $coupon->label          = $request->label;
        $coupon->code          = $request->code;
        $coupon->discount       = $request->discount;
        $coupon->starts         = $request->starts;
        $coupon->ends           = $request->ends;
        $coupon->limit          = $request->limit;
        
        $coupon->save();

        return redirect()->route('coupons.index');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    public function redeem(Request $request)
    {
        $coupon = Coupon::where('code',$request->code)->first();
        if($coupon){
            if($coupon->redeemed < $coupon->limit){
                $price = Option::where("slug","price")->first()->value;
                $discount = $price * ($coupon->discount * .01);
                $discount_final  = $price - $discount;
                return redirect()->back()->with('discount_final', $discount_final )->with('coupon_id',$coupon->id);
            }else{
                return Redirect::back()->with('message','El cupón ya llegó a su limite'); 
            }
            
        }else{
            return Redirect::back()->with('message','El cupón no existe'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->back();
    }
}
