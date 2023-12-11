<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Laravel\Cashier\Cashier;


class ProductController extends Controller
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

    public function getAllProducts(){
        
        $products = Products::get()->toArray();
        return view('products',compact('products'));
    }
    public function viewProducts($id){
        $user = auth()->user();
        $product = Products::where('id',$id)->get()->first()->toArray(); 
        $intent = $user->createSetupIntent();      
        return view('single-product',compact('product','intent'));
    }
    public function checkout(Request $request, $id)
    {
        $paymentMethodId = $request->input('stripeToken');

        try {
            $product = Products::find($id);

            // Charge the user using Laravel Cashier
            $user = $request->user();
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethodId);

            $user->charge($product->price * 100, $user->currency);
            dd("teste");
            // Handle successful payment (e.g., redirect to a thank you page)
            return redirect()->route('thankyou')->with('success', 'Payment successful!');
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Handle the exception
            dd($e->getMessage());
        }
    }
    // ProductController.php

public function thankYou()
{
    return view('thankyou');
}


}
