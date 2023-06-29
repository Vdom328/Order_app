@php
    use App\Classes\Enums\StatusUserEnum;
@endphp

@extends('admin.layouts.master')
@section('title')
    Profile
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}">
@endsection

@section('content')
    <div class="page-inner">
        <div class="row row-xs">
            <div class="col-lg-4 col-xl-3">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <div class="d-flex align-items-center mg-b-20">
                            <div class="profile-avatar-setting mr-3">
                                <div class="avatar-wrapper">
                                    <img class="profile-pic img-fluid rounded"
                                        src="{{ asset('storage/' . $user->avatar) ?? '' }}">
                                    <div class="upload-button">
                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                    </div>
                                    <input id="avatar-file" class="file-upload" name="avatar" type="file"
                                        accept="image/*" />
                                </div>
                            </div>
                            <div>
                                <h2 class="tx-15">
                                    {{ $user->first_name && $user->last_name ? $user->first_name . ' ' . $user->last_name : 'User name' }}
                                </h2>
                                <p class="tx-12 mb-0">{{ $user->role_name }}</p>
                                @if ($user->account_status == StatusUserEnum::Active)
                                    <p class="tx-12 mb-0" id="data-account-status">Active</p>
                                @elseif ($user->account_status == StatusUserEnum::Inactive)
                                    <p class="tx-12 mb-0" id="data-account-status">Inactive</p>
                                @endif
                            </div>
                        </div>
                        <ul class="nav nav-pills flex-column tx-medium ac-setting-navi">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center active" data-toggle="pill"
                                    href="#setting-account-info" aria-expanded="false">
                                    <i data-feather="cpu" class="wd-16 ht-16 mr-2"></i>
                                    <span>Account Information</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" data-toggle="pill"
                                    href="#setting-change-password" aria-expanded="false">
                                    <i data-feather="settings" class="wd-16 ht-16 mr-2"></i>
                                    <span>Change Password</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" data-toggle="pill" href="#setting-social-link"
                                    aria-expanded="false">
                                    <i data-feather="life-buoy" class="wd-16 ht-16 mr-2"></i>
                                    <span>Social Links</span>
                                </a>
                            </li>
                        </ul>
                        <hr>
                        @if ($user->account_status == StatusUserEnum::Active)
                            <button type="button" id="account-toggle-button"
                                class="tx-medium btn btn-danger waves-effect">Deactivate Your Account?</button>
                        @elseif ($user->account_status == StatusUserEnum::Inactive)
                            <button type="button" id="account-toggle-button"
                                class="tx-medium btn btn-success waves-effect">Activate Your Account?</button>
                        @endif

                    </div>

                </div>
            </div>
            <div class="col-lg-8 col-xl-9">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="setting-account-info">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between pd-15">
                                <h6 class="mb-0">Account Information</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.user.updateAccount', $user->id) }}" id="account-form"
                                    novalidate="">
                                    <div class="row mg-t-20">
                                        <label class="col-lg-3 form-control-label tx-left tx-lg-right form-label">First
                                            Name:</label>
                                        <div class="col-lg-6 mg-t-10 mg-sm-t-0">
                                            <input type="text" class="form-control" placeholder="Enter First Name"
                                                name="first_name" value="{{ $user->first_name ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="row mg-t-20">
                                        <label class="col-lg-3 form-control-label tx-left tx-lg-right form-label"> Last
                                            Name:</label>
                                        <div class="col-lg-6 mg-t-10 mg-sm-t-0">
                                            <input type="text" class="form-control" placeholder="Enter Last Name"
                                                name="last_name" value="{{ $user->last_name ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <p class="mb-0">
                                            Your email is not confirmed. Please check your inbox.
                                        </p>
                                        <a href="">Resend confirmation</a>
                                    </div>
                                    <div class="row mg-t-20">
                                        <label class="col-lg-3 form-control-label tx-left tx-lg-right form-label"><span
                                                class="tx-danger">*</span> Email:</label>
                                        <div class="col-lg-6 mg-t-10 mg-sm-t-0">
                                            <input type="email" class="form-control" placeholder="Enter Email"
                                                name="email" value="{{ $user->email ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="row mg-t-20">
                                        <label class="col-lg-3 form-control-label tx-left tx-lg-right form-label">
                                            Adress:</label>
                                        <div class="col-lg-6 mg-t-10 mg-sm-t-0">
                                            <input type="text" class="form-control" placeholder="Enter Adress"
                                                name="address" value="{{ $user->address ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="row mg-t-20">
                                        <label class="col-lg-3 form-control-label tx-left tx-lg-right form-label">
                                            Telephone:</label>
                                        <div class="col-lg-6 mg-t-10 mg-sm-t-0">
                                            <input type="text" class="form-control" placeholder="Enter Telephone"
                                                name="telephone" value="{{ $user->telephone ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="row mg-t-20">
                                        <label class="col-lg-3 form-control-label tx-left tx-lg-right form-label">
                                            Gender:</label>
                                        <div class="col-lg-6 mg-t-10 mg-sm-t-0">
                                            <select class="selectpicker form-control" name="gender">
                                                <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>Female
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mg-t-20">
                                        <label class="col-lg-3 form-control-label tx-left tx-lg-right form-label">
                                            Role:</label>
                                        <div class="col-lg-6 mg-t-10 mg-sm-t-0">
                                            <select class="selectpicker form-control" name="role_id">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mg-t-30">
                                        <div class="col-sm-8 mg-l-auto">
                                            <div class="form-layout-footer">
                                                <button type="button" id="save-account-form"
                                                    class="btn btn-primary waves-effect">Save Changes</button>
                                                <a href="{{ route('admin.user.list') }}"
                                                    class="btn btn-default waves-effect">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="setting-change-password" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between pd-15">
                                <h6 class="mb-0">Change Password</h6>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-warning alert-bordered pd-y-15" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="mdi mdi-close tx-16"></i></span>
                                    </button>
                                    <div class="d-sm-flex align-items-center justify-content-start">
                                        <i class="mdi mdi-alert alert-icon tx-50 mg-r-20 tx-warning"></i>
                                        <div class="mg-t-20 mg-sm-t-0">
                                            <h5 class="mg-b-2 tx-warning">Configure user passwords alert</h5>
                                            <p class="mg-b-0">Configure user passwords to expire periodically. Users will
                                                need warning that their passwords are going to expire,
                                                or they might inadvertently get locked out of the system!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <label class="col-lg-3 form-control-label tx-left tx-lg-right form-label">Old
                                            Password:</label>
                                        <div class="col-lg-6 mg-t-10 mg-sm-t-0">
                                            <input type="password" class="form-control" required=""
                                                placeholder="Old Password"
                                                data-validation-required-message="This old password field is required">
                                            <a href="" class="tx-10">Forgot password ?</a>
                                        </div>
                                    </div>
                                    <div class="row mg-t-20">
                                        <label class="col-lg-3 form-control-label tx-left tx-lg-right form-label">New
                                            Password:</label>
                                        <div class="col-lg-6 mg-t-10 mg-sm-t-0">
                                            <input type="password" name="password" class="form-control"
                                                placeholder="New Password" required=""
                                                data-validation-required-message="The password field is required"
                                                minlength="6">
                                        </div>
                                    </div>
                                    <div class="row mg-t-20">
                                        <label class="col-lg-3 form-control-label tx-left tx-lg-right form-label">Retype
                                            Password:</label>
                                        <div class="col-lg-6 mg-t-10 mg-sm-t-0">
                                            <input type="password" name="con-password" class="form-control"
                                                required="" data-validation-match-match="password"
                                                placeholder="New Password"
                                                data-validation-required-message="The Confirm password field is required"
                                                minlength="6">
                                        </div>
                                    </div>
                                    <div class="row mg-t-30">
                                        <div class="col-sm-8 mg-l-auto">
                                            <div class="form-layout-footer">
                                                <button class="btn btn-primary waves-effect">Save Changes</button>
                                                <a href="{{ route('admin.user.list') }}"
                                                    class="btn btn-default waves-effect">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="setting-social-link" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between pd-15">
                                <h6 class="mb-0">Social Links </h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.user.updateSocialLink', $user->id) }}"
                                    id="social-links-form">
                                    @csrf
                                    <div class="row">
                                        <label
                                            class="col-lg-3 form-control-label tx-left tx-lg-right form-label">Facebook:</label>
                                        <div class="col-lg-6 mg-t-10 mg-sm-t-0">
                                            <input name="facebook" type="text" class="form-control"
                                                value="{{ $user->facebook }}" placeholder="http://facebook.com/username">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label
                                            class="col-lg-3 form-control-label tx-left tx-lg-right form-label">Twitter:</label>
                                        <div class="col-lg-6 mg-t-10 mg-sm-t-0">
                                            <input name="twitter" type="text" class="form-control"
                                                value="{{ $user->twitter }}" placeholder="http://twitter.com/username">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label
                                            class="col-lg-3 form-control-label tx-left tx-lg-right form-label">Linkedin:</label>
                                        <div class="col-lg-6 mg-t-10 mg-sm-t-0">
                                            <input name="linkedin" type="text" class="form-control"
                                                value="{{ $user->linkedin }}" placeholder="http://linkedin.com/username">
                                        </div>
                                    </div>
                                    <div class="row mg-t-30">
                                        <div class="col-sm-8 mg-l-auto">
                                            <div class="form-layout-footer">
                                                <button type="button" id="save-social-links-form"
                                                    class="btn btn-primary waves-effect">Save Social Links</button>
                                                <a href="{{ route('admin.user.list') }}"
                                                    class="btn btn-default waves-effect">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/cleavejs/cleave.min.js') }}"></script>
    <!-- END: Vendor JS-->
    <!-- BEGIN: Init JS-->
    <script>
        $(document).ready(function() {
            // active menu items
            $('.user').addClass('open active');
            $('.sub-menu').css('display', 'block');
            $('.list_user').addClass('active');
            // File Uploader
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".file-upload").on('change', function() {
                readURL(this);
            });

            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });
            // update file avater
            $("#avatar-file").on("change", function() {
                var formData = new FormData();
                formData.append("avatar", this.files[0]);
                console.log(formData);
                $.ajax({
                    url: "{{ route('admin.user.updateAvatar', $user->id) }}",
                    method: "POST",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $.growl.success({
                            message: 'Update avatar successfully !'
                        });
                    },
                    error: function(xhr, status, error) {
                        $.growl.error({
                            message: 'An error occurred, please try again !'
                        });
                    }
                });
            });
            // update social-links-form
            $('#save-social-links-form').click(function(event) {
                event.preventDefault();
                var form = $('#social-links-form');
                var url = form.attr('action');
                myAjaxCall(url, 'POST', form.serialize(),
                    function(data) {},
                    function(errorResponse) {
                        // Xử lý errorResponse khi lỗi
                    },
                    'Update social links successfully !',
                    'An error occurred, please try again !'
                )
            });
            // update acccout
            $('#save-account-form').click(function(event) {
                event.preventDefault();
                var form = $('#account-form');
                var url = form.attr('action');
                myAjaxCall(url, 'POST', form.serialize(),
                    function(data) {},
                    function(error) {

                    },
                    'Update account successfully !',
                    'An error occurred, please try again !'
                )
            });
            // update acccout
            $('#account-toggle-button').click(function() {
                var url = "{{ route('admin.user.toggleStatus', $user->id) }}";
                myAjaxCall(url, 'POST', {},
                    function(data) {
                        if (data.status === 'success') {
                            if ($('#account-toggle-button').hasClass('btn-danger')) {
                                $('#account-toggle-button')
                                    .removeClass('btn-danger')
                                    .addClass('btn-success')
                                    .text('Activate Your Account?');
                                $('#data-account-status').text('Inactive');
                            } else {
                                $('#account-toggle-button')
                                    .removeClass('btn-success')
                                    .addClass('btn-danger')
                                    .text('Deactivate Your Account?');
                                $('#data-account-status').text('Active');
                            }
                        } else {
                            $.growl.error({
                                message: 'An error occurred, please try again !'
                            });
                        }
                    },
                    function(errorResponse) {
                        alert('An error occurred, please try again !');
                    },
                    'Update account successfully !',
                    'An error occurred, please try again !'
                )
            });
        });
    </script>
@endsection
