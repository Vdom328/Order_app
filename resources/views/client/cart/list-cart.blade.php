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

        .category {}

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
        .button-odder{
            display: none;
        }
        .footer-cart{
    font-size: 14px;
}
.footer-cart button{
    font-size: 18px;
    display: flex;
    /* padding-top: 10px; */
    padding: 6px 20px;
    align-items: center;
    justify-content: center;
}
    </style>
@endsection

@section('content')
    <div class="menu-container mt-3">
        <div class="category" id="list_food">
            {{-- list food --}}

        </div>
        <div class="border footer-detail p-2 shadow">
            <div class="d-flex justify-content-between footer-cart">
                <div>
                    <div id="point-cart" class="d-flex">Total: <div class="number-cart ps-2"></div></div>
                    <span id="price-footer-cart"></span><span> Total Price: <span class="price-product"></span></span>
                </div>
                <div>
                    <button class="sk-button sk-fill-button" id="click-ordernow-detail">Order now</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@include('client.cart.partials._modal')
<script>
    $(document).ready(function() {
        // list food by local storage
        const attrCart = JSON.parse(localStorage.getItem('cart')) || [];
        for (i = 0; i < attrCart.length; i++) {
            const food = attrCart[i];
            let price = (food.quantity * food.price).toLocaleString('en')
            let html = '<div class="item" id="food_' + food.food_id +'">\
                                <img src="{{ asset('images/a.jpg') }}" alt="Appetizer 1">\
                                <div class="item-content">\
                                    <h3>' + food.name + '</h3>\
                                    <div class="quantity-container d-flex align-items-center justify-content-between">\
                                        <span class="price" id="price_' + food.food_id + '">$' + price + '</span>\
                                        <div>\
                                            <button class="btn-food decrease-qty decrease-quantity">-</button>\
                                            <input type="hidden" name="price_food" class="price_food" value="' + food
                .price + '">\
                                            <input type="hidden" name="id_food" class="id_food" value="' + food
                .food_id +
                '">\
                                            <input type="number" class="input-food quantity" id="qty" name="qty" value="' + food
                .quantity + '"\
                                                min="1">\
                                            <button class="btn-food increase-qty increase-quantity">+</button>\
                                        </div>\
                                    </div>\
                                </div>\
                                <i class="delete-icon fas fa-times" data-food-id="' + food.food_id + '"></i> \
                            </div>';

            $('#list_food').append(html);
        }

        $(document).on("click", ".increase-quantity", function() {
            changeQuantity('increase', this);
        });

        $(document).on("click", ".decrease-quantity", function() {
            changeQuantity('decrease', this);
        });

        $(document).on("click", ".delete-icon", function() {
            $('#deleteModal').modal('show');
            $('.submit_delete_food').attr('data-food-id', $(this).data('food-id'));
        });

        $(document).on("click", ".submit_delete_food", function() {
            removeItemFromCart($(this).attr('data-food-id'));
        });
        // JavaScript function to handle quantity change
        function changeQuantity(operation, element) {
            var quantityElement = $(element).parent().find('.quantity');
            var priceElement = $(element).parent().find('.price_food');
            var foodId = $(element).parent().find('.id_food');
            var quantity = parseInt(quantityElement.val());

            if (operation === 'increase') {
                quantity += 1;
            } else if (operation === 'decrease' && quantity > 1) {
                quantity -= 1;
            }

            quantityElement.val(quantity);
            let totalPrice = (priceElement.val() * quantity).toLocaleString('en')
            $('#price_' + foodId.val()).text('$' + totalPrice);

            // Update quantity in local storage
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const updatedCart = cart.map(food => {
                if (food.food_id == foodId.val()) {
                    return {
                        ...food,
                        quantity: quantity
                    };
                }
                return food;
            });
            localStorage.setItem('cart', JSON.stringify(updatedCart));
            updateFoodTer();
        }

        function removeItemFromCart(foodId) {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const updatedCart = cart.filter(food => food.food_id != foodId);
            localStorage.setItem('cart', JSON.stringify(updatedCart));

            // Remove the item's HTML from the DOM
            $('#food_' + foodId).remove();
            updateFoodTer();
        }
    });
</script>
@endsection
