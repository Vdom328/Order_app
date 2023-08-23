@extends('admin.auth.layout.master')
@section('title')
Sign In
@endsection
@section('css')

@endsection

@section('content')
    <!--================================-->
    <!-- Page Content Start -->
    <!--================================-->
    <div class="ht-100v text-center">
        <div class="row no-gutters pd-0 mg-0">
            <div class="col-lg-4 bg-gray-100">
                <div class="ht-100v d-flex align-items-center justify-content-center">
                    <form method="POST" action="{{ route('admin.auth.postLogin') }}" class="wd-300">
                        @csrf
                        <h3 class="mg-b-5 tx-left">Sign In</h3>
                        <p class="tx-12 mg-b-30 tx-left">Welcome back! Please signin to continue.</p>
                        <div class="form-group tx-left">
                            <label class="mg-b-5">Email address</label>
                            <input name="email"  class="form-control" placeholder="email@domain.com">
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mg-b-5">
                                <label class="mg-b-0">Password</label>
                                <a href="{{ route('admin.auth.getForgot') }}" class="tx-15 mg-b-0">Forgot password?</a>
                            </div>
                            <input name="password" type="password" class="form-control" placeholder="Enter your password">
                        </div>
                        <button class="btn btn-lg btn-outline-primary rounded-pill btn-block waves-effect">Sign In</button>

                        {{-- <div class="tx-15 mg-t-20 tx-center">Don't have an account? <a href="aut-signup.html"
                                class="tx-dark">Create an Account</a></div> --}}
                    </form>
                </div>
            </div>
            <div class="col-lg-8 bg-image hidden-sm">
            </div>
        </div>
    </div>
    <!--/ Page Content End -->
@endsection
@section('js')
@endsection
