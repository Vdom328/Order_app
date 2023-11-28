@extends('client.layouts.master')

@section('css')
    @vite(['resources/css/client/order_now.css'])
@endsection

@section('content')
    <div class="">
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
                    <a href="/history" class="pay-Notification1-item">
                        <p class="pay-Notification1-tittle">Order Confirmation</p>
                    </a>
                    <p class="price-product" id="price">0$</p>
                </div>
                <div>
                    <img src="{{ asset('images/payment.png') }}" alt="" width="100%" height="auto">
                </div>
            </div>
            {{-- coupons --}}
            <div class="col-12 mt-3">
                <label for="" class="fw-bold">Coupons</label>
                <div class="col-12 d-flex">
                    <div class="col-9 ">
                        <input type="text" name="coupons" id="coupons-value"  class="form-control">
                    </div>
                    <div class="col-3">
                        <button class="sk-fill-button button-odder" id="coupons">Save</button>
                    </div>
                </div>
            </div>
            {{-- price --}}
            <div class="col-12 mt-3">
                <label for="" class="fw-bold">Total price: 4000$ - 300$ = 3700$</label>
            </div>
            <div>
                <div class="paycard">Again</div>
                <div  class="paymentCart" id="submit_form_order">
                    <div class=" pay-card p-t3">
                        <img src="{{ asset('images/apple-logo.png') }}" alt="" width="14px" height="auto"
                            class="icon-payment">
                        <span>Pay</span>
                    </div>
                </div>
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
        <form id="payment-form" method="post" action="{{ route('client.getOrderSuccess') }}">
            @csrf
            <input type="hidden" name="attrCart" id="attrCart">
            <input type="hidden" name="inforOrder" id="inforOrder">
        </form>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            const attrCart = JSON.parse(localStorage.getItem('cart')) || [];
            const inforOrder = JSON.parse(localStorage.getItem('infor_order')) || [];
            $(document).on("click", "#submit_form_order", function() {
                const attrCartJson = JSON.stringify(attrCart);
                const inforOrderJson = JSON.stringify(inforOrder);

                // Đặt giá trị cho các trường input ẩn
                $("#attrCart").val(attrCartJson);
                $("#inforOrder").val(inforOrderJson);

                // Submit form
                $("#payment-form").submit();
            });

            // click coupons
            let totalPrice = 0;
            for (let i = 0; i < attrCart.length; i++) {
                const product = attrCart[i];
                totalPrice += product.quantity * product.price;
            }
            $(document).on("click", "#coupons", function() {
                let coupon = $('#coupons-value').val();
                if (!coupon || coupon == '') {
                    return;
                }
                $.ajax({
                    url: "{{ route('admin.coupons.create') }}",
                    type: 'POST',
                    data: {
                        coupon: coupon,
                        totalPrice: totalPrice
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            })
        });
    </script>
@endsection
