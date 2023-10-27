@extends('client.layouts.master')

@section('css')
    <style>
        /* Add your custom CSS styles for the food item detail page here */
        .food-item-details {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .food-item-details img {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .food-item-details h2 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #333;
            word-wrap: break-word;
        }

        .food-item-details p {
            font-size: 18px;
            margin-bottom: 10px;
            color: #666;
            word-wrap: break-word;
        }

        .food-item-details .quantity {}

        .food-item-details .quantity input {
            width: 60px;
            text-align: center;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 0 10px;
        }

        .food-item-details .quantity .btn {
            font-size: 18px;
            /* padding: 5px; */
            background-color: #f44336;
            border: none;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .food-item-details .quantity .btn:hover {
            background-color: #d32f2f;
        }
    </style>
@endsection

@section('content')
    <div class="row mt-1">
        <div class="col-md-12">
            <div class="food-item-details p-3">
                <img src="{{ asset('images/a.jpg') }}" alt="Food Item Image">
                <h2>{{ $food->name }}</h2>
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
                        <button class="btn decrease-qty">-</button>
                        <input type="number" id="qty" name="qty" value="1" min="1">
                        <button class="btn increase-qty">+</button>
                    </div>
                </div>
                <button class="btn btn-primary mt-3" id="add_to_cart">Add to Cart</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            var dataFood = @json($food);
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
                const attrCart = JSON.parse(localStorage.getItem('cart')) || [];

                const cartIndex = attrCart.findIndex(cart => cart.food_id == dataFood.id);

                if (cartIndex > -1) {
                    attrCart[cartIndex].quantity += parseInt($('#qty').val());
                } else {
                    attrCart.push({
                        'food_id': dataFood.id,
                        'quantity': parseInt($('#qty').val())
                    });
                }

                localStorage.setItem('cart', JSON.stringify(attrCart));
            });


        });
    </script>
@endsection
