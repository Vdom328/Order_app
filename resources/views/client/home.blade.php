@extends('client.layouts.master')

@section('css')
@vite([
    'resources/css/client/home.css'
])
@endsection

@section('content')
    <div class="ps-1 pt-4 col-12 d-flex">
        <h4 class="fw-bold col-6">Best sale
        </h4>
    </div>
    <div class="col-12 fw-bold pt-3">
        <div class="mt-1 mb-3 p-3 item_w d-flex  bg_img" style="background-image: url('{{ asset('images/hinh-1.jpg') }}')">
            <div class="col-7 d-flex flex-column justify-content-between">
                <div>
                    <h5>Pizza</h5>
                    <span class="mb-0 opa">Ejnoy Pizaa from Food Ejnoy Pizaa from Food</span>
                </div>
            </div>
        </div>
        <div class="ps-1 pt-4 col-12 d-flex">
            <div class="col-6 pe-2">
                <div class="mt-1 mb-3 p-3 item_w d-flex  bg_img"
                    style="background-image: url('{{ asset('images/hinh-1.jpg') }}')">
                    <div class="col-7 d-flex flex-column justify-content-between">
                        <div>
                            <h5>Pizza</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 ps-2">
                <div class="mt-1 mb-3 p-3 item_w d-flex  bg_img"
                    style="background-image: url('{{ asset('images/hinh-1.jpg') }}')">
                    <div class="col-7 d-flex flex-column justify-content-between">
                        <div>
                            <h5>Pizza</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- deals --}}
        <div class="ps-1 pt-4 col-12 d-flex">
            <h4 class="fw-bold col-6">Deals
            </h4>
            <div class="col-6 text-end pe-2">
                <i class="fas fa-arrow-right"></i>
            </div>
        </div>
        <div class="col-12 mt-1">
            <div id="food-slider" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="carousel-item @if ($i == 0) active @endif">
                            <div class="p-3 item_w  d-flex flex-column justify-content-end bg_img"
                                style="background-image: url('{{ asset('images/a.jpg') }}')">
                                <div class="minute_icon col-1">5 %</div>
                            </div>
                            <div class="col-12 d-flex mt-2">
                                <div class="col-7 ps-1">Pizaaa</div>
                                <div class="col-5 text-end pe-3">
                                    <i class="fas fa-star text-warning"></i>
                                    <span class="pl-1">4.5</span>
                                </div>
                            </div>
                            <div class="ps-1 col-12 opa text_note">Ejnoy Pizaa from Food Ejnoy Pizaa from Food Ejnoy Pizaa
                                from Food</div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        {{--  --}}
        <div class="ps-1 pt-4 col-12 d-flex">
            <h4 class="fw-bold col-6">Explore More
            </h4>
        </div>
        @for ($j = 0; $j < 5; $j++)
            <div class="mt-1 mb-3 p-3 item_w d-flex  bg_img"
                style="background-image: url('{{ asset('images/hinh-1.jpg') }}')">
                <div class="col-7 d-flex flex-column justify-content-between text_note">
                    <div>
                        <h5>Pizza</h5>
                        <span class="mb-0 opa">Ejnoy Pizaa from Food Ejnoy Pizaa from Food</span>
                    </div>
                    <div>
                        <span class="mb-0 ">Money</span>
                        <p class="mb-0 text-warning">$ 30</p>
                    </div>
                </div>
            </div>
        @endfor
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        var restaurant = @json($restaurant);
        localStorage.setItem('restaurant', JSON.stringify(restaurant));
    })
</script>
@endsection
