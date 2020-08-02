{{-- Updated for Bootstrap --}}
@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
<!-- END PAGE LEVEL CUSTOM STYLES -->
<style>
    .select2-close-mask {
        z-index: 2099;
    }

    .select2-dropdown {
        z-index: 3051;
    }

    .btn svg {
        opacity: 0;
    }

    .btn.active svg {
        opacity: 1;
    }

</style>

@endsection

@section('content')
<div class="container mb-5">
    <form class="row mt-5" action="{{ url('orders') }}" method="POST" novalidate="" id="payment-form">
        @csrf
        <h1 class="col-md-12 mt-5 font-weight-bold text-center mb-5">{{ $title }}</h1>
        <div class="col-md-12" id="card-errors">
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
        </div>

        <div class="col-md-5">
            <div class="col-md-12 card p-5">
                <h5>Box Summary</h5>
                <table class="card-body table">
                    <tr>
                        <th>Frequency</th>
                        <td>{{ $order['frequency'] }}/month</td>
                    </tr>
                    <tr>
                        <th>Duration</th>
                        <td>{{ $order['duration'] }} months</td>
                    </tr>
                    <tr>
                        <th>Cycle</th>
                        <td>{{ $order['cycle'] }}</td>
                    </tr>
                    <tr>
                        <th>Box Amount</th>
                        <td>${{ $order['amount'] }}</td>
                    </tr>
                    <tr>
                        <th>Service Fee</th>
                        <td>${{ $order['fee'] }}</td>
                    </tr>
                </table>
                <div class="card-footer">
                    <div class="row">
                        <div class="col font-weight-bold">Total Amount</div>
                        <div class="col font-weight-bold">${{ ($order['amount']+$order['fee']) * $order['duration'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 card p-5">
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text" class="form-control" id="firstName" name="user[first_name]" placeholder="First name" required="">
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <input type="text" class="form-control" id="lastName" name="user[last_name]" placeholder="Last name" required="">
                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-7">
                    <input type="email" class="form-control" id="email" name="user[email]" placeholder="Email Address">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="form-group col-md-5">
                    <input type="tel" class="form-control" id="phone" name="user[phone]" placeholder="Enter phone number">
                    <div class="invalid-feedback">
                        Please enter a valid phone address for shipping updates.
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="user[address][address]" id="address" placeholder="Shipping Address" required="">
                <div class="invalid-feedback">
                    Please enter your shipping address.
                </div>
            </div>

            <div class="row">
                <div class="col-md-7 form-group">
                    <input type="text" class="form-control" id="address2" name="user[address][house]" placeholder="Apartment or suite (Optional)">
                </div>

                <div class="col-md-5 form-group">
                    <select class="custom-select d-block w-100 basic" id="state" name="user[address][state]" required="">
                        <option value="">Select State</option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                    <div class="invalid-feedback">
                        Please provide a valid state.
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Payment method</label>
                <div class="custom-control custom-radio custom-control-inline">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="payment_method" type="radio" class="custom-control-input" checked="" required="" value="credit">
                        <label class="custom-control-label pr-2" for="credit">
                            <div class="d-inline">Credit </div>
                            <div class="d-none d-sm-inline-block">card</div>
                        </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="payment_method" type="radio" class="custom-control-input" required="" value="debit">
                        <label class="custom-control-label pr-2" for="debit">
                            <div class="d-inline">Debit </div>
                            <div class="d-none d-sm-inline-block">card</div>
                        </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="" value="paypal">
                        <label class="custom-control-label" for="paypal">Paypal</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" id="cc-name" placeholder="Name on card" required="">
                <div class="invalid-feedback">
                    Name on card is required
                </div>
            </div>

            <div class="form-group">
                <div id="card-element" class="form-control"></div>
            </div>

            <div class="form-group">
                <button id="card-button" class="btn btn-lg btn-block bg-dark btn-order">Place your order</button>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <span class="payment-errors" id="card-errors" style="color: red;margin-top:10px;"></span>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script src="https://js.stripe.com/v3/"></script>

<script>
    var style = {
        base: {
            color: '#32325d'
            , lineHeight: '18px'
            , fontFamily: '"Helvetica Neue", Helvetica, sans-serif'
            , fontSmoothing: 'antialiased'
            , fontSize: '16px'
            , '::placeholder': {
                color: '#aab7c4'
            }
        }
        , invalid: {
            color: '#fa755a'
            , iconColor: '#fa755a'
        }
    };

    const stripe = Stripe('{{ env("STRIPE_TEST_KEY") }}', {
        locale: 'en'
    });
    const elements = stripe.elements();
    const card = elements.create('card', {
        style: style
    });

    card.mount('#card-element');

    card.addEventListener('change', function(event) {
        if (event.error) {
            $('#card-errors').html('<div class="alert alert-warning">' + event.error.message + '</div>');
        } else {
            $('#card-errors').html('');
        }
    });

    var form = $('#payment-form');

    form.submit(function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                $('#card-errors').html('<div class="alert alert-warning">' + result.error.message + '</div>');
            } else {
                stripeTokenHandler(result.token);
            }
        });

        const {
            paymentMethod
            , error
        } = stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: {
                    name: $('#cc-name').val()
                }
            }
        );

        if (error) {
            $('#card-errors').html('<div class="alert alert-warning">' + error.message + '</div>');
        } else {
            $('#payment-form').append('<input type="hidden" name="paymentMethod" value="' + paymentMethod + '">');
        }
    });

    function stripeTokenHandler(token) {
        var form = $('#payment-form');

        form.append('<input type="hidden" name="stripeToken" value="' + token.id + '">');
        form.submit();
    }

    var ss = $(".basic").select2({
        tags: true
    });

</script>

@endsection
