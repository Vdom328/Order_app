<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>My awesome food store</title> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/client/style.css', 'resources/js/client/app.js', 'resources/css/client/common.css', 'resources/css/client/foodter.css', 'resources/js/common.js'])
    @yield('css')
</head>

<body>
    <div id="spinner">
        <i class="fa fa-spinner fa-spin"></i>
    </div>
    <div class="main-wrapper">
        @include('client.layouts.partials.sidebar')
        <div class="site-content-wrapper">
            {{-- icon sidebar --}}
            @include('client.layouts.partials.header')
            {{-- content --}}
            <div class="site-content ps-3 pe-3 pt-5">
                @yield('content')
            </div>
        </div>
        {{-- modal add role --}}
        @include('client.layouts.partials.foodter')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- choose one -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <script>
        updateFoodTer()
        function updateFoodTer() {
            const attrCart = JSON.parse(localStorage.getItem('cart')) || [];
            const routeHome = JSON.parse(localStorage.getItem('route_home')) || [];

            let totalPrice = 0;
            for (let i = 0; i < attrCart.length; i++) {
                const product = attrCart[i];
                totalPrice += product.quantity * product.price;
            }
            $('.price-product').html(totalPrice.toLocaleString('en') + '$');
            $('.number-cart').html(attrCart.length.toLocaleString('en'));
            $('.route_home').attr('href', routeHome);
        }
    </script>
    @yield('js')
    <script>
        $(document).ready(function() {
            var restaurant = JSON.parse(localStorage.getItem('restaurant'));
            $('.name_restaurant').html(restaurant.name)
            var imagePath = "{{ asset('storage/logo') }}" + '/' + restaurant.logo;
            $(".logo_restaurant").attr("src", imagePath);
            $('.phone_restaurant').html(restaurant.phone);
            $('.email_restaurant').html(restaurant.email)
            let time_restaurant = '(' + restaurant.start_time + ' - ' + restaurant.end_time + ')';
            $('.time_restaurant').html(time_restaurant)

            // click foodter
            $(document).on("click", "[data-href]", function() {
                const href = $(this).data('href');
                window.location.href = href;
            });

        });
    </script>
</body>

</html>
