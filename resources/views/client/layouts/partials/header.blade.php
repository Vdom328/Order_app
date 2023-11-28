<div class="nav-trigger col-12 shadow d-flex p-0 bg-white">
    <div class="col-2 icon_sidebar d-flex p-1 align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-bar-chart">
            <line x1="12" y1="20" x2="12" y2="10" />
            <line x1="18" y1="20" x2="18" y2="4" />
            <line x1="6" y1="20" x2="6" y2="16" />
        </svg>
    </div>
    <div class="col-5">
        <span class="fw-bold name-restaurant">Restaurant</span><br>
        <span class="table-number">Table 5</span>
    </div>
    <div class="col-5 d-flex justify-content-end align-items-center">
        @if (Auth()->check())
            <a href="{{ route('client.history') }}" class="col-3">
                <i class="fas fa-history bell-icon"></i>
            </a>
            {{-- <div class="col-3">
                <i class="fas fa-user bell-icon"></i>
            </div> --}}
            <a href="{{ route('client.getLogout') }}" class="col-3">
                <i class="fas fa-sign-out-alt bell-icon"></i>
            </a>
        @else
            <a href="{{ route('client.getLogin') }}" class="col-3">
                <i class="fas fa-sign-in-alt bell-icon"></i>
            </a>
        @endif
    </div>
</div>
