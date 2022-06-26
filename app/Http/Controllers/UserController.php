<?php

namespace App\Http\Controllers;

use App\Models\Plan;

class UserController extends Controller
{

    public function dashboard()
    {
        //return view('backend.user_dashboard');
        return redirect('/user/stripe');
    }

    public function exampleStripe(){

        $user = Auth()->user();

        $plans = Plan::all();

        if($user->subscription('bronze')){
            $current_subscription = 'bronze';
        }
        elseif($user->subscription('silver')){
            $current_subscription = 'silver';
        }
        elseif($user->subscription('gold')){
            $current_subscription = 'gold';
        }
        else{
            $current_subscription = null;
        }

        $current_invoices = $user->invoicesIncludingPending();
        $upcoming_invoice = $user->upcomingInvoice();
        //dd($upcoming_invoice);

        return view('backend.stripe.exampleStripe',compact('plans','user','current_subscription','current_invoices','upcoming_invoice'));
    }

    public function stripeCancel()
    {
        $user = Auth()->user();

        if($user->subscription('bronze')){
            $user->subscription('bronze')->cancel();
        }
        elseif($user->subscription('silver')){
            $user->subscription('silver')->cancel();
        }
        elseif($user->subscription('gold')){
            $user->subscription('gold')->cancel();
        }

        return redirect()->route('billing');
    }

    public function stripeResume()
    {
        $user = Auth()->user();

        if($user->subscription('bronze')){
            $user->subscription('bronze')->resume();
        }
        elseif($user->subscription('silver')){
            $user->subscription('silver')->resume();
        }
        elseif($user->subscription('gold')){
            $user->subscription('gold')->resume();
        }

        return redirect()->route('billing');
    }

    public function exampleGraphql(){

        return view('backend.exampleGraphql');
    }

    public function exampleMobile(){

        return view('backend.exampleMobile');
    }

    public function exampleSocials(){

        return view('backend.exampleSocials');
    }

    public function internalProjects($name){

        //Replace hyphens
        $name = str_replace('-',' ',$name);

        //Stripe
        if($name == 'stripe integration'){
            return redirect('/user/stripe');
        }

        //Calendar
        if($name == 'calendar'){
            return redirect('/user/calendar');
        }

        //GraphQL
        if($name == 'graphql'){
            return redirect('/user/graphql');
        }

        //Mobile verification
        if($name == 'mobile verification'){
            return redirect('/user/mobile');
        }

        //Socials
        if($name == 'socials login'){
            return redirect('/user/socials');
        }
    }
}
