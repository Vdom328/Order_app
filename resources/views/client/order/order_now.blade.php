@extends('client.layouts.master')

@section('css')
    @vite(['resources/css/client/order_now.css'])
    <style>
        .model-buy-2{
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="content-payment-success">
        <div class="payment-success-header">
            {{-- <img src="{{asset('img/check.png')}}" alt="" width="40%"> --}}
            <span class="fa fa-check-circle"></span>
            <div class="success-header-item">
                <h4>Order Successful !</h4>
            </div>
        </div>
        <div class="payment-success-main">
            @php
                $total = 0;
            @endphp

            <div class="list-cart-payment">
                @foreach ($attr_cart as $item)
                    <ul>
                        <li>{{ $item['name'] }}</li>
                        <li>{{ number_format($item['quantity'] * $item['price']) }}$</li>
                    </ul>

                    @php
                        $total += $item['quantity'] * $item['price'];
                    @endphp
                @endforeach
            </div>

            <div class="payment-success-main-footer">
                <ul>
                    <li>Total</li>
                    <li id="totalPrice">{{ number_format($total) }}$</li>
                </ul>
            </div>

        </div>
        <div>
            <div class="success-header-item">
            <h5>Thank you for your meal !</h5>
            </div>
        </div>
    </div>
@endsection
<script>
        localStorage.removeItem('cart');
</script>
@section('js')
