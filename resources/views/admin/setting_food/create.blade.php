@extends('admin.layouts.master')
@section('title')
    Create User
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}">
@endsection

@section('content')
    <div class="page-inner-content">
        <div class="row no-gutters">
            <!--================================-->
            <!-- Page Content Area Start -->
            <!--================================-->
            <div class="col-lg-12 page-content-area ">
                <div class="inner-content">
                    <form action="{{ route('admin.user.postCreate') }}" method="post" class="modal-body col-12" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <div class="col col-12  custom-fieldset">
                            <!-- Account status radio buttons -->
                            <div class="row">
                                <div class="col col-12 col-lg-12">
                                    <div class="form-check d-flex justify-content-end">
                                        <label class="form-check-label m-0" style="font-size: 13px ; padding: 6px 28px">
                                            <input type="radio"
                                                   class="form-check-input"
                                                   name="account_status"
                                                   value="1"
                                                   {{ old('account_status') == '1' ? 'checked' : '' }}>
                                            Active
                                        </label>
                                        <label class="form-check-label m-0" style="font-size: 13px; padding: 6px 28px">
                                            <input type="radio"
                                                   class="form-check-input"
                                                   name="account_status"
                                                   value="2"
                                                   {{ old('account_status') == '2' ? 'checked' : '' }}>
                                            Inactive
                                        </label>
                                    </div>
                                    <p class="w-100 error text-danger d-flex justify-content-end">{{ $errors->first('account_status') }}</p>
                                </div>
                            </div>
                            <!-- avater ,role input field -->
                            <div class="mb-4">
                                <div class="row d-flex flex-wrap">
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 col-md-6">Avatar </div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="form-control w-100" name="avatar" id="avatar" type="file"  value="{{ old('avatar') }}" style="padding: 0.575rem 0.75rem 2px;">
                                            <p class="w-100 error text-danger">{{ $errors->first('avatar') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 col-md-6">Role </div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            
                                            <p class="w-100 error text-danger">{{ $errors->first('last_name') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- name input field -->
                            <div class="mb-4">
                                <div class="row d-flex flex-wrap">
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 col-md-6">Fist name </div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="form-control w-100" name="first_name" id="first_name" type="text"  value="{{ old('first_name') }}">
                                            <p class="w-100 error text-danger">{{ $errors->first('first_name') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 col-md-6">Last name </div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="form-control w-100" name="last_name" id="last_name"
                                                type="text" value="{{ old('last_name') }}">
                                            <p class="w-100 error text-danger">{{ $errors->first('last_name') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Email input field -->
                            <div class="mb-4">
                                <div class="row d-flex flex-wrap">
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 ">Email <span class="text-danger">*</span></div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="form-control w-100" name="email" id="email" type="text" value="{{ old('email') }}">
                                            <p class="w-100 error text-danger">{{ $errors->first('email') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 ">Address </div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="form-control w-100" name="address" id="address" type="text" value="{{ old('address') }}">
                                            <p class="w-100 error text-danger">{{ $errors->first('address') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- password --}}
                            <div class="mb-4">
                                <div class="row d-flex flex-wrap">
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 ">password <span class="text-danger">*</span></div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="form-control w-100" name="password" id="password" value="{{ old('password') }}"
                                                type="password">
                                            <p class="w-100 error text-danger">{{ $errors->first('password') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 ">Confirm Password <span class="text-danger">*</span>
                                        </div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="form-control w-100" name="confirm_pass" id="confirm_pass" value="{{ old('confirm_pass') }}"
                                                type="password">
                                            <p class="w-100 error text-danger">{{ $errors->first('confirm_pass') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Telephone input field -->
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col col-12 ">Phone Number </div>
                                    <div class="col col-12 col-lg-12 mt-2">
                                        <input class="form-control w-100" name="telephone" id="telephone" type="number" value="{{ old('telephone') }}">
                                        <p class="w-100 error text-danger">{{ $errors->first('telephone') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Gender radio buttons -->
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col col-12">Gender</div>
                                    <div class="col col-12 col-lg-12 mt-3">
                                        <div class="form-check-inline">
                                            <label class="form-check-label mr-3">
                                                <input type="radio"
                                                       class="form-check-input"
                                                       name="gender"
                                                       value="1"
                                                       {{ old('gender') == '1' ? 'checked' : '' }}>
                                                Male
                                            </label>
                                            <label class="form-check-label">
                                                <input type="radio"
                                                       class="form-check-input"
                                                       name="gender"
                                                       value="2"
                                                       {{ old('gender') == '2' ? 'checked' : '' }}>
                                                Female
                                            </label>
                                        </div>
                                        <p class="w-100 error text-danger">{{ $errors->first('gender') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- input field -->
                            <div class="mb-4 col-12 d-flex flex-wrap p-0">
                                <div class="col col-12 p-0 ">Facebook </div>
                                <div class="col col-12 p-0 col-lg-12 mt-2">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-facebook wd-16 ht-16 ">
                                                    <path
                                                        d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                    </path>
                                                </svg></span>
                                        </div>
                                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{ old('facebook') }}"
                                            placeholder="http://facebook.com">
                                    </div>
                                    <p class="w-100 error text-danger">{{ $errors->first('facebook') }}</p>
                                </div>
                                <div class="col col-12 p-0 ">Twitter </div>
                                <div class="col col-12 p-0 col-lg-12 mt-2">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-twitter wd-16 ht-16 ">
                                                    <path
                                                        d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                                    </path>
                                                </svg></span>
                                        </div>
                                        <input type="text" name="twitter" id="twitter" class="form-control" value="{{ old('twitter') }}"
                                            placeholder="http://twitter.com">
                                    </div>
                                    <p class="w-100 error text-danger">{{ $errors->first('twitter') }}</p>
                                </div>
                                <div class="col col-12 p-0 ">Linkedin </div>
                                <div class="col col-12 p-0 col-lg-12 mt-2">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-linkedin wd-16 ht-16 ">
                                                    <path
                                                        d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                                                    </path>
                                                    <rect x="2" y="9" width="4" height="12">
                                                    </rect>
                                                    <circle cx="4" cy="4" r="2"></circle>
                                                </svg></span>
                                        </div>
                                        <input type="text" name="linkedin" id="linkedin" class="form-control" value="{{ old('linkedin') }}"
                                            placeholder="http://linkedin.com">
                                    </div>
                                    <p class="w-100 error text-danger">{{ $errors->first('Linkedin') }}</p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success waves-effect" id="submitForm">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--/ Page Content Area End -->
            <!--================================-->
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/dataTable/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dataTable/responsive/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>

@endsection
