@extends('client.layouts.master')

@section('css')
    @vite(['resources/css/client/order_now.css'])
@endsection

@section('content')
    <div class="content-payment-success" style="padding-top: 35%;">
        <div class="payment-success-header error-img">
            <img src="{{asset('images/delete.png')}}" alt="" width="40%" >
        </div>
        <div class="payment-success-main error-tittle">
            <h2>Having problems ordering food !</h2>
            <p>Please rescan the QR code.</p>
        </div>
    </div>
@endsection
@section('js')
