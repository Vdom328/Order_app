@extends('client.layouts.master')

@section('css')
@vite(['resources/css/client/detail.css'])
@endsection

@section('content')
    <div class="row mt-1">
        <div class="col-md-12">
            <div class="food-item-details p-3">
                @if ($food->foodImages->count() <= 1)
                    <img src="{{ asset('images/a.jpg') }}">
                @else
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @for ($i = 0; $i < $food->foodImages->count(); $i++)
                                <div class="carousel-item @if ($i == 0) active @endif ">
                                    <img src="{{ asset('storage/food_images/' . $food->foodImages->toArray()[$i]['image']) }}" class="d-block w-100" alt="...">
                                </div>
                            @endfor
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @endif
                <h2>{{ $food->name }}</h2>
                <p class="fw-bold">{{ \App\Classes\Enum\TypeMealEnum::getLabel($restaurant_meal->meal) }}</p>
                <p>Only available during business hours:
                    {{ \Carbon\Carbon::parse($restaurant_meal->start_time)->format('H:i') }} -
                    {{ \Carbon\Carbon::parse($restaurant_meal->end_time)->format('H:i') }}</p>
                <p>{{ $food->memo }}</p>
                <p class="fw-bold">Price: ${{ number_format($food->price) }}</p>
            </div>

            <div class="food-item-details p-3 mt-3">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <div class="col-6">
                        <div class="price d-flex">
                            <div class="fw-bold">
                                Total:
                            </div>
                            <div id="total_price" class="ms-2">

                            </div>

                        </div>
                    </div>
                    <div class="col-6 quantity d-flex align-items-center justify-content-end">
                        <button class="btn-food decrease-qty">-</button>
                        <input class="input-food" type="number" id="qty" name="qty" value="1"
                            min="1">
                        <button class="btn-food increase-qty">+</button>
                    </div>
                </div>
                <button class="btn btn-primary mt-3" id="add_to_cart">Add to Cart</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('client.detail.partials._modal')
    <script>
        $(document).ready(function() {
            var dataFood = @json($food);
            var restaurant_meal = @json($restaurant_meal);
            var price = dataFood['price'];

            // Add your JavaScript code for the food item detail page here
            $('.increase-qty').click(function() {
                var qtyInput = $('#qty');
                var currentQty = parseInt(qtyInput.val());
                if (isNaN(currentQty)) {
                    currentQty = 0;
                }
                qtyInput.val(currentQty + 1);
                // update price
                updatePrice();
            });

            $('.decrease-qty').click(function() {
                var qtyInput = $('#qty');
                var currentQty = parseInt(qtyInput.val());
                if (isNaN(currentQty)) {
                    currentQty = 0;
                }
                if (currentQty > 1) {
                    qtyInput.val(currentQty - 1);
                    updatePrice();
                }
            });

            updatePrice();

            $(document).on("input", "#qty", function() {
                updatePrice();
            })

            // update price
            function updatePrice() {
                var qtyInput = $('#qty');
                var currentQty = parseInt(qtyInput.val());
                if (isNaN(currentQty)) {
                    currentQty = 0;
                }

                // Calculate and update the total price
                var totalPrice = price * currentQty;
                // $('#total_price').text(totalPrice+ '$');
                $('#total_price').text(totalPrice.toLocaleString('en') + '$');

            }

            // update or push storage cart
            $(document).on("click", "#add_to_cart", function() {
                $.ajax({
                    url: "{{ route('client.checkTimeAddCart') }}",
                    method: 'get',
                    data: {
                        restaurant_meal_id: restaurant_meal.id,
                        food_id: dataFood.id
                    },
                    success: function(response) {
                        if (response.data == true) {
                            updateLocalStorage();
                        } else {
                            $('#staticBackdrop').modal('show');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

            });

            function updateLocalStorage() {
                const attrCart = JSON.parse(localStorage.getItem('cart')) || [];
                const cartIndex = attrCart.findIndex(cart => cart.food_id == dataFood.id);
                if (cartIndex > -1) {
                    attrCart[cartIndex].quantity += parseInt($('#qty').val());
                } else {
                    attrCart.push({
                        'food_id': dataFood.id,
                        'quantity': parseInt($('#qty').val()),
                        'price': dataFood.price,
                        'name': dataFood.name,
                        'image': @json($img)[0].image,
                    });
                }

                localStorage.setItem('cart', JSON.stringify(attrCart));
                updateFoodTer();
                window.location.href = "{{ route('client.getListCart') }}"
            }
        });
    </script>
@endsection
