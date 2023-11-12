<div class="nav-background">
    <div class="mobile-logo">
        <img src="" alt="">
    </div>
    <div class="mobile-nav">
        <div class="cart">
            <div class="flex items-center">
                <img src="" alt="" class="logo_restaurant">
                <div class="name_restaurant"></div>
            </div>
        </div>
        <div class="nav-top">
            <ul>
                <li>
                    <a href="" class="route_home">Home</a>
                </li>
                <li>
                    <a href="#">About us</a>
                </li>
                @if (Auth()->check())
                <li>
                    <a href="{{ route('client.getLogout') }}">Log out</a>
                </li>
                @else
                <li>
                    <a href="{{ route('client.getLogin') }}">Log in</a>
                </li>
                 @endif
            </ul>
        </div>
        <div class="contact flex items-center">
            <div>
                <h5>Call us: <span  class="phone_restaurant"></span></h5>
                <h6>E-mail : <span  class="email_restaurant"></span></h6>
            </div>
        </div>
        <div class="time flex items-center">
            <div>
                <h5>Working Hours: <span class="time_restaurant"> </span></h5>
            </div>
        </div>
    </div>
</div>
