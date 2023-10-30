@extends('client.layouts.master')

@section('css')
@vite(['resources/css/client/order_now.css'])
@endsection

@section('content')
<div class="content-payment-success">
    <div class="payment-success-header">
        {{-- <img src="{{asset('img/check.png')}}" alt="" width="40%"> --}}
        <span class="fa fa-check-circle"></span>
        <div class="success-header-item">
            <h4>Order Successful</h4>
        </div>
    </div>
    <div class="payment-success-main">
        <div class="list-cart-payment">
            <ul>
                <li>name</li>
                <li>3</li>
            </ul>
        </div>
        <div class="payment-success-main-footer">
            <ul>
                <li>Total</li>
                <li id="totalPrice">0$</li>
            </ul>
        </div>
    </div>
    <div>
        <div class="success-header-item">
            <h5>Thank you for your meal</h5>
        </div>
    </div>
</div>
@endsection
@section('js')
