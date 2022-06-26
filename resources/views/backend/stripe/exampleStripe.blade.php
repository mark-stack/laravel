@extends('backend.backend_master')

@section('content')


<div class="page-wrapper">

    <div class="page-breadcrumb">
      <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
          <h4 class="page-title">Stripe Example</h4>
        </div>
      </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p>
                            A demonstation in using the payment processor 'Stripe' for monthly subscription billing.
                            This doesn't use real money, but will create, manage, cancel, upgrade, downgrade the billing plan. 
                        </p>
                        <hr>
                        @if($current_subscription == null)
                            <h5>You're currently on the Free plan</h5>
                        @endif

                        <div class="row">
                            <div class="col-lg-8 text-center">
                                @if(session('message')) 
                                    <div class="alert alert-info"><strong>{{session('message')}}</strong></div>
                                @endif

                                <div class="row">
                                    @foreach($plans as $plan)
                                        <div class="col-md-4" style="padding:10px">
                                            <div style="border: solid 2px black;border-radius:10px 10px 0px 0px;">
                                                <br>
                                                <h3>{{ ucwords($plan->name) }}</h3>
                                                <b>${{ number_format($plan->price/100,2) }}</b> USD<br><br>
                                            </div>
                                            <div>
                                                @if($user->subscribed($plan->name)) 
                                                    <div style="padding:6px 0px 7px 0px; background-color:#00ff6412;border: solid 2px black;width:100%;border-radius: 0px 0px 8px 8px">
                                                        @if($user->subscription($current_subscription)->onGracePeriod())
                                                            <strong>You're cancelled on a grace period</strong>
                                                        @else 
                                                            <strong>You're subscribed to this plan</strong>
                                                        @endif
                                                    </div>

                                                    @if($user->subscription($current_subscription)->onGracePeriod())
                                                        <a href="/user/resume" class="btn btn-primary btn-sm" style="margin-top:4px;border-radius:3px">Resume</a>
                                                    @else
                                                        <a href="/user/cancel" class="btn btn-danger btn-sm" style="margin-top:4px;border-radius:3px" onclick="return confirm('Are you sure?')">Cancel Subscription</a>
                                                    @endif
                                                @else 
                                                    <a href="/user/checkout/{{$plan->id}}" class="btn btn-primary" style="border: solid 2px black;width:100%;border-radius: 0px 0px 8px 8px">
                                                        @if($current_subscription == 'bronze' && $plan->name == 'silver') 
                                                            Upgrade to {{ ucwords($plan->name) }} plan
                                                        @elseif($current_subscription == 'bronze' && $plan->name == 'gold') 
                                                            Upgrade to {{ ucwords($plan->name) }} plan
                                                        @elseif($current_subscription == 'silver' && $plan->name == 'bronze')
                                                            Downgrade to {{ ucwords($plan->name) }} plan
                                                        @elseif($current_subscription == 'silver' && $plan->name == 'gold') 
                                                            Upgrade to {{ ucwords($plan->name) }} plan
                                                        @elseif($current_subscription == 'gold' && $plan->name == 'bronze')
                                                            Downgrade to {{ ucwords($plan->name) }} plan
                                                        @elseif($current_subscription == 'gold' && $plan->name == 'silver') 
                                                            Downgrade to {{ ucwords($plan->name) }} plan
                                                        @else 
                                                            Subscribe to {{ ucwords($plan->name) }} plan
                                                        @endif
                                                        
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                @if($upcoming_invoice)
                                    <hr>
                                    <h3>Upcoming Invoice</h3>
                                    <p>After upgrading or downgrading, a balancing invoice will be issued after the grace period (1 day)</p>
                                @endif

                                @if($current_invoices->count() > 0)
                                    <hr>
                                    <h3>Invoices history</h3>
                                    <div class="row">
                                        <div class="col-md-12" style="padding:10px;text-align:left">
                                            <table style="width:100%">
                                                <tr>
                                                    <th>Invoice #</th>
                                                    <th>View Online</th>
                                                    <th>Download</th>
                                                </tr>
                                                @foreach($current_invoices as $i)
                                                    <tr>
                                                        <td>{{$i->id}}</td>
                                                        <td><a href="{{$i->hosted_invoice_url}}" class="btn btn-primary btn-sm" target="_blank">View Online</a></td>
                                                        <td><a download href="{{$i->invoice_pdf}}" class="btn btn-primary btn-sm">Download</a></td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


