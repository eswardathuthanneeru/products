<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        return view('home', [
            'intent' => $user->createSetupIntent(),
        ]);
    }

    public function stripeIndex()
    {

        return view('striphome');
        // $user = auth()->user();
        // return view('home', [
        //     'intent' => $user->createSetupIntent(),
        // ]);
    }

    public function singleCharge(Request $request){
        $amount = $request->amount;
        $paymentMethod = $request->payment_method;
        $user = auth()->user();
        $user->createOrGetStripeCustomer();
        $paymentMethod = $user->addPaymentMethod($paymentMethod);
        $user->charge($amount * 100, $paymentMethod->id);
        return to_route('thankyou');
        //return $request->all();
        //3782 822463 10005
    }
}
