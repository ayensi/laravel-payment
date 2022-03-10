<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pay(Request $request){
        $rules = [
            'amount' => ['required','numeric','5'],
            'currency' => ['required','exists:currencies,iso'],
            'payment_platform' => ['required','exists:paymentPlatform,id'],
        ];
        $request->validate([
            'amount' => ['required','numeric','min:5'],
            'currency' => ['required','exists:currencies,iso'],
            'payment_platform' => ['required','exists:payment_platforms,id'],
        ]);

        return $request->all();
    }
}
