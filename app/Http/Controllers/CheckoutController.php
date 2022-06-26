<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class CheckoutController extends Controller
{
    public function checkout($id){

        //User
        $user = Auth()->user();

        //Plan in local DB
        $plan = Plan::findorfail($id);

        //Current subscriptions
        $bronze = $user->subscription('bronze');
        $silver = $user->subscription('silver');
        $gold = $user->subscription('gold');

        //Changing from bronze
        if($bronze && $bronze->stripe_price != $plan->stripe_plan_id){
            $user->subscription('bronze')->swap($plan->stripe_plan_id);
            $bronze->name = $plan->name;
            $bronze->save();
            return redirect()->route('billing');  
        }
        //Changing from silver
        if($silver && $silver->stripe_price != $plan->stripe_plan_id){
            $user->subscription('silver')->swap($plan->stripe_plan_id);
            $silver->name = $plan->name;
            $silver->save();
            return redirect()->route('billing');  
        }
        //Changing from gold
        if($gold && $gold->stripe_price != $plan->stripe_plan_id){
            $user->subscription('gold')->swap($plan->stripe_plan_id);
            $gold->name = $plan->name;
            $gold->save();
            return redirect()->route('billing');  
        }

        //No existing plans
        $intent = Auth()->user()->createSetupIntent();
        return view('backend.stripe.exampleStripeCheckout',compact('plan','intent'));
    }

    public function processCheckout(Request $request){

        //Get plan
        $plan = Plan::findorfail($request->input('billing_plan_id'));

        //Create payment method
        $user = Auth()->user();
     
        try{
            $user->newSubscription($plan->name, $plan->stripe_plan_id)->create($request->input('payment-method'));
            
            return redirect()->route('billing')->withMessage('Subscribed successfully');
        } catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        
    }
}
