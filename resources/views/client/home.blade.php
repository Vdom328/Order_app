@extends('client.layouts.master')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />


<style>

    </style>
    @endsection

    @section('content')
    <div class="col-12 fw-bold pt-2">
        <h2>Category</h2>
        <div class="swiper-container">
                @for ($i = 1; $i <= 10; $i++)
                <div class="col-6 p-0">
                    <div class="swiper-slide">
                        <img src="{{ asset('assets/images/bg/authen-bg.jpg') }}" alt="Food Item" width="100%" height="auto">
                        <div class="food-details">
                            <h4>Food Name {{$i}}</h4>
                            <div class="ratings">
                                <span class="rating">&#9733;</span>
                                <span class="rating">&#9733;</span>
                                <span class="rating">&#9733;</span>
                                <span class="rating">&#9733;</span>
                                <span class="rating">&#9734;</span>
                            </div>
                            <p class="price">$9.99</p>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
    </div>
    @endsection

@section('js')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
// Initialize Swiper.js
var swiper = new Swiper('.swiper-container', {
    slidesPerView: 'auto',
    spaceBetween: 20,
    centeredSlides: true,
    grabCursor: true,
});
</script>
@endsection
