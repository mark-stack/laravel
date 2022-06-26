@extends('backend.backend_master')

@section('content')

<style> 
    button * {
    pointer-events: none;
    }
    .loading {
    opacity: .5;
    }
    .loading span {
    display: none;
    }
</style>

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
            <div class="col-lg-5" style="padding:0px;">
                <div class="card" style="height:100%;border-radius:10px">
                   
                    <div class="card-header" style="background-color:#1f262d;color:white;border-radius: 10px 10px 0px 0px">
                        <strong>Billing for {{ ucwords($plan->name) }} plan (TEST MODE)</strong>
                    </div>
                    <div class="alert alert-info" style="border-left: solid 2px black;border-right: solid 2px black;margin-bottom: 0px;">
                        <strong style="font-size:16px">Details for testing:</strong>
                        <br>Card Number: <strong>4242 4242 4242 4242</strong>
                        <br>Expiry & CVC: <strong>anything</strong>
                    </div>
                    <div class="card-body" style="background-color:white;border-radius: 0px 0px 10px 10px;border-left: solid 2px black;border-right: solid 2px black;border-bottom: solid 2px black;">

                        @if(session('error')) 
                            <div class="alert alert-danger">{{session('error')}}</div>
                        @endif

                        <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                            @csrf 
                            <input type="hidden" name="billing_plan_id" value="{{$plan->id}}"> 
                            <input type="hidden" name="payment-method" id="payment-method" value=""> 
        
                            <input id="card-holder-name" type="text" placeholder="Card holder name" style="margin-bottom:10px;width:100%">
        
                            <!-- Stripe Elements Placeholder -->
                            <div id="card-element"></div>
                            <br>
                            <button id="card-button" class="btn btn-primary">
                                Pay ${{ number_format($plan->price/100,2) }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script> 
        function LoadingSpinner (form, spinnerHTML) {
            form = form || document

            //Keep track of button & spinner, so there's only one automatic spinner per form
            var button
            var spinner = document.createElement('div')
            spinner.innerHTML = spinnerHTML
            spinner = spinner.firstChild

            //Delegate events to a root element, so you don't need to attach a spinner to each individual button.
            form.addEventListener('click', start)

            //Stop automatic spinner if validation prevents submitting the form
            //Invalid event doesn't bubble, so use capture
            form.addEventListener('invalid', stop, true)

            //Start spinning only when you click a submit button
            function start (event) {
                if (button) stop()
                button = event.target
                if (button.type === 'submit') {
                LoadingSpinner.start(button, spinner)
                }
            }

            function stop () {
                LoadingSpinner.stop(button, spinner)
            }

            function destroy () {
                stop()
                form.removeEventListener('click', start)
                form.removeEventListener('invalid', stop, true)
            }

            return {start: start, stop: stop, destroy: destroy}
            }

            LoadingSpinner.start = function (element, spinner) {
            element.classList.add('processing...')
            return element.appendChild(spinner)
            }

            LoadingSpinner.stop = function (element, spinner) {
            element.classList.remove('processing...')
            return spinner.remove()
            }

            var exampleForm = document.querySelector('#checkout-form')
            var exampleLoader = new LoadingSpinner(exampleForm, 'processing...')
    </script>

@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
      $( document ).ready(function() {
        let stripe = Stripe("{{ env('STRIPE_KEY') }}")
        let elements = stripe.elements()
        let style = {
          base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
              color: '#aab7c4'
            }
          },
          invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
          }
        }
        let card = elements.create('card', {style: style})
        card.mount('#card-element')
        let paymentMethod = null
        $('#checkout-form').on('submit', function (e) {
          if (paymentMethod) {
            return true
          }
          stripe.confirmCardSetup(
            "{{ $intent->client_secret }}",
            {
              payment_method: {
                card: card,
                billing_details: {name: $('#card-holder-name').val()}
              }
            }
          ).then(function (result) {
            if (result.error) {
              console.log(result)
              alert('error')
            } else {
              paymentMethod = result.setupIntent.payment_method
              $('#payment-method').val(paymentMethod)
              $('#checkout-form').submit()
            }
          })
          return false
        })
      });
    </script>
@endsection


@section('styles')
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endsection 