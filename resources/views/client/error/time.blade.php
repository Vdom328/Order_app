<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/client/order_now.css'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="content-payment-success d-flex flex-column justify-content-center align-items-center" style="height: 100vh">
        <div class="payment-success-header error-img">
            <img src="{{ asset('images/close.png') }}" alt="" width="40%">
        </div>
        <div style="width:93%;" class="payment-success-main error-tittle">
            <h2>The store is not open yet !</h2>
            <p>Please come back later.</p>
        </div>
        <div style="width:93%;" class="payment-success-main error-tittle error-time">
            <h2 >Open time</h2>
            <div class="list_time_error">
                @foreach ($time_error as $item)
                    <ul class="list_error_day">
                        {{ $item['meal'] }} : {{ $item['start_time'] }} - {{ $item['end_time'] }} 
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
    <style>
        .error-img img {
            box-shadow: 0 0 10px rgb(156 136 80), 0 0 20px rgb(156 136 80), 0 0 30px rgb(156 136 80);
            border: none;
            margin: 0;
            margin-top: 25px;
        }

        .error-tittle h2 {
            font-size: 25px;
        }

        .error-tittle p {
            margin-bottom: 0;
        }

        .list_time_error {
            border-top: 1px solid;
        }

        .list_error_day {
            margin-bottom: 0;
            display: block !important;
            text-align: center;
        }
    </style>
</body>

</html>
