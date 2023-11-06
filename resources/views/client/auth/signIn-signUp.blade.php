<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    @vite(['resources/css/client/auth/style.css'])
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="{{ asset('assets/plugins/jquery.growl/jquery.growl.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/client/common.css', 'resources/js/common.js'])
</head>
{{-- <p class="social-text">Or Sign in with social platforms</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div> --}}
<body>
    <div id="spinner">
        <i class="fa fa-spinner fa-spin"></i>
    </div>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form id="login-form" action="{{ route('client.postLogin') }}" method="post" class="sign-in-form">
                    @csrf
                    <h2 class="title">Sign In</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" name="email" class="form-control error_email" placeholder="Email" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" class="form-control  error_password" placeholder="Password" />
                    </div>
                    <div style="width:100%">
                        <p class="w-100 ps-5 error_email" style="color: red"></p>
                        <p class="w-100 ps-5 error_password" style="color: red"></p>
                    </div>
                    <input type="submit" value="Login" class="btn-auth  solid" />
                </form>

                <form id="register_form" action="{{ route('client.postRegister') }}" method="post" class="sign-up-form">
                    @csrf
                    <h2 class="title">Sign Up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" class="form-control" name="first_name" placeholder="First name" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text"  class="form-control" name="last_name" placeholder="Last name" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email"   class="form-control" name="email" placeholder="Email" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password"  class="form-control" name="password" placeholder="Password" />
                    </div>
                    <div style="width:100%" id="error_register">
                    </div>
                    <input type="submit" value="Sign Up" class="btn-auth  solid" />
                </form>
            </div>
        </div>
        <div class="panels-container">

            <div class="panel left-panel">
                <div class="content">
                    <h3>New here?</h3>
                    <p>Do not have an account ?</p>
                    <button class="btn-auth  transparent" id="sign-up-btn">Sign Up</button>
                </div>
                <img src="{{ asset('images/log.svg') }}" class="image" alt="">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us?</h3>
                    <p>Do you already have an account ?</p>
                    <button class="btn-auth  transparent" id="sign-in-btn">Sign In</button>
                </div>
                <img src="{{ asset('images/register.svg') }}" class="image" alt="">
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                const routeHome = JSON.parse(localStorage.getItem('route_home')) || [];
                $("#sign-up-btn").click(function() {
                    $(".container").addClass("sign-up-mode");
                });

                $("#sign-in-btn").click(function() {
                    $(".container").removeClass("sign-up-mode");
                });

                $(document).on("submit", "#login-form", function(event) {
                    event.preventDefault(); // Prevent default form submission

                    var form = $(this);
                    var url = form.attr("action");
                    console.log(url);
                    var data = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        success: function(response) {
                            console.log(response);
                            if (response.error) {
                                $('.error_email').text(response.error);
                                return ;
                            }
                            if (response.success) {
                                window.location.href = routeHome;
                            }
                        },
                        error: function(error) {
                            $.each( error.responseJSON.errors, function( key, value ) {
                                $('.error_' + key).text(value).addClass( 'is-invalid' );
                            });
                        }
                    });
                });

                $(document).on("submit", "#register_form", function(event) {
                    event.preventDefault(); // Prevent default form submission

                    var form = $(this);
                    var url = form.attr("action");
                    var data = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        success: function(response) {
                            if (response.error) {
                                html = '<p class="w-100 ps-5 error_email" style="color: red"> ' + response.error +'</p>'
                                $('#error_register').html(html);
                                return ;
                            }
                            if (response.success) {
                                $(".container").removeClass("sign-up-mode");
                            }
                        },
                        error: function(error) {
                            let html = '';
                            $.each( error.responseJSON.errors, function( key, value ) {
                                html += '<p class="w-100 ps-5 error_email" style="color: red"> ' + value +'</p>'
                            });
                            $('#error_register').html(html);
                        }
                    });
                });
            });
        </script>
</body>

</html>
