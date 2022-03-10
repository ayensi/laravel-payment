@extends('layouts.app')

@section('content')
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
<div class="container">
    <form action="{{route('pay')}}" method="post" id="paymentForm">
@csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Payment') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-body">
                            <div class="row mt-2">
                            <label for="amount">Amount to pay:</label>
                            <input
                                type="number"
                                min="5"
                                step="0.01"
                                class="form-control"
                                name="amount"
                                value="{{mt_rand(100, 100000)/100}}"
                            required>
                            </div>
                            <div class="row mt-2">
                                <label for="currency">Currency:</label>
                                <select required name="currency" id="currencySelect" class="form-control">
                                    @foreach($currencies as $currency)
                                        <option value="{{$currency->iso}}">{{strtoupper($currency->iso)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mt-2">
                                <label for="paymentPlatform">Payment platform:</label>
                                <div class="form-group">
                                    <div class="btn-group btn-group-toggle">
                                        @foreach($paymentPlatforms as $platform)
                                            <label class="btn rounded m-2 p-1">

                                                <input required id="{{ strtolower($platform->name) }}" style="position: absolute;width: 0;height: 0;opacity: 0;" type="radio" class="btn-check"
                                                name="payment_platform"
                                                value="{{$platform->id}}"
                                                >
                                                <img style="cursor: pointer;" class="img-thumbnail" width="100px" src="{{asset($platform->image)}}">
                                            </label>
                                        @endforeach
                                    </div>
                                    @foreach($paymentPlatforms as $platform)
                                        <div style="display: none" id="div-{{strtolower($platform->name)}}">
                                            @includeIf ('components.'. strtolower($platform->name).'-collapse')
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" id="payButton" class="btn btn-dark mt-1">Pay</button>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<style>
    [type=radio]:checked + img {
        outline: 2px solid grey;
    }
</style>
<script>
    $("#paypal").click(function(event) {
        $("#div-paypal").slideToggle();
        if($("#div-stripe").is(":visible")){
            $("#div-stripe").slideToggle();
        }
    });
    $("#stripe").click(function(event) {
        $("#div-stripe").slideToggle();
        if($("#div-paypal").is(":visible")){
            $("#div-paypal").slideToggle();
        }


    });
</script>
@endsection
