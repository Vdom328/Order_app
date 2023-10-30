@extends('client.layouts.master')

@section('css')
@vite(['resources/css/client/order_now.css'])
@endsection

@section('content')
<div class="content-payment">
    <div class="d-flex pay-warning">
        <div class="warning-icon"><span class="fa fa-exclamation-triangle"></span></div>
        <div>
            <div>
                Have you received all the items you ordered?
            </div>
            <div class="warning-pay-tittle">
                When you make a payment, you will be charged even if your order has been processed
            </div>
        </div>
    </div>
    <div class="main-payment">
        <div class=" pay-Notification">
            <div class="pay-Notification1">
                <p>Amount to pay</p>
                <p class="pay-Notification1-monney"></p>
                <a href="/history" class="pay-Notification1-item"><p class="pay-Notification1-tittle">Order Confirmation</p></a>
            </div>
            <div>
                <img src="{{asset('img/payment.png')}}" alt="" width="100%" height="auto">
            </div>
        </div>
        <div >
            <div class="paycard">Again</div>
            <a href="/paymentsucces" class="paymentCart">
                <div class=" pay-card p-t3">
                    <img src="{{asset('img/apple-logo.png')}}" alt="" width="14px" height="auto" class="icon-payment">
                    <span>Pay</span>
                </div>
            </a>
        </div>
    </div>

    <div class="pay-tittle">Pay all at once</div>
    <div class="pay-tittle1">
        <span>Easy payment with smartphone</span><br>
        <span class="pay-tittle-1">Immediate payment by credit card</span>
    </div>
    <div class=" pay-tittle-card">Credit card registration</div>

    <div class="pay-footer ">
        <span>Payment is different from online payment</span><br>
        <span class="pay-footer-1">Please pay directly at the cash register</span>
    </div>
</div>
@endsection
@section('js')
@endsection
