@extends('client.layouts.master')

@section('css')
    <style>
        /* Your custom CSS styles for the food menu go here */
        .menu-container {
            max-width: 100%;
        }

        h1 {
            text-align: center;
        }

        .category {
            margin-bottom: 30px;
        }

        .item {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 10px;
            border-radius: 30px;
        }

        .item .item-content {
            flex: 1;
        }

        h3 {
            margin-top: 0;
        }

        p {
            margin: 0;
        }

        span {
            font-weight: bold;
        }

        .delete-icon {
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 20px;
            color: #ff0000;
            /* Màu đỏ cho icon xóa */
            cursor: pointer;
        }

        .quantity-container {
            display: flex;
            align-items: center;
        }

        .quantity-button {
            cursor: pointer;
            padding: 5px 10px;
            background-color: #007BFF;
            /* Màu nền cho nút */
            color: #fff;
            /* Màu chữ cho nút */
            border-radius: 5px;
            margin: 0 5px;
        }
    </style>
@endsection

@section('content')
    <div class="menu-container mt-3">
        @for ($i = 0; $i < 5; $i++)
            <div class="category">
                <div class="item">
                    <img src="{{ asset('images/a.jpg') }}" alt="Appetizer 1">
                    <div class="item-content">
                        <h3>Item 1</h3>
                        <p>Description of item 1.</p>
                        <div class="quantity-container d-flex align-items-center justify-content-between">
                            <span class="price">$10</span>
                            <div>
                                <button class="btn-food decrease-qty decrease-quantity">-</button>
                                <input type="number" class="input-food quantity" id="qty" name="qty" value="1"
                                    min="1">
                                <button class="btn-food increase-qty increase-quantity">+</button>
                            </div>
                        </div>
                    </div>
                    <i class="delete-icon fas fa-times"></i> <!-- Icon delete -->
                </div>
            </div>
        @endfor
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(document).on("click", ".increase-quantity", function() {
                changeQuantity('increase', this);
            });

            $(document).on("click", ".decrease-quantity", function() {
                changeQuantity('decrease', this);
            });

            // JavaScript function to handle quantity change
            function changeQuantity(operation, element) {
                var quantityElement = $(element).parent().find('.quantity');
                var quantity = parseInt(quantityElement.val());

                if (operation === 'increase') {
                    quantity += 1;
                } else if (operation === 'decrease' && quantity > 0) {
                    quantity -= 1;
                }

                quantityElement.val(quantity);
            }
        });
    </script>
@endsection
