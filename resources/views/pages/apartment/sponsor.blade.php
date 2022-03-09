@extends('layouts.main-layout')
@section('title')
    Sponsor
@endsection

@section('content')
    <div class="container my-5">
        <h1><b>Sponsorizza : </b>{{$apartment -> title}}</h1>
        <div class="row my-5">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table" >
                        <div class="row display-tr" >
                            <h3 class="panel-title display-td">Dettagli Pagamento</h3>
                        </div>                    
                    </div>
                    <div class="panel-body">

                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                    <form role="form" action="{{ route('apartment.sponsor.checkout', $apartment -> id) }}" method="post" class="require-validation"
                    data-cc-on-file="false"
                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                    id="payment-form">
                        @csrf

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Livello</label>
                                {{-- <input name="amount" class='form-control' size='4' type='number'> --}}
                                <select name="amount" class='form-control'>
                                    <option value="2.99">Standard - 2.99 &euro;</option>
                                    <option value="5.99">Premium - 5.99 &euro;</option>
                                    <option value="9.99">Elite - 9.99 &euro;</option>
                                </select>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Nome e Cognome</label> <input
                                    class='form-control' size='4' type='text' value="test">
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Numero della Carta</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text' value="4242 4242 4242 4242">
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVV</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text' value="123">
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Mese di scadenza</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text' value="02">
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Anno di scadenza</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text' value="2024">
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-blue btn-lg btn-block" type="submit">Paga ora</button>
                            </div>
                        </div>
                            
                        </form>
                    </div>
                </div>        
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        
    <script type="text/javascript">
    $(function() {
        var $form         = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        var $form         = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                            'input[type=text]', 'input[type=file]',
                            'textarea'].join(', '),
            $inputs       = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid         = true;
            $errorMessage.addClass('hide');

            $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
        var $input = $(el);
        if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
        }
        });

        if (!$form.data('cc-on-file')) {
        e.preventDefault();
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
        }

    });
    function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                // token contains id, last4, and card type
                var token = response['id'];
                // insert the token into the form so it gets submitted to the server
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });
    </script>
@endsection