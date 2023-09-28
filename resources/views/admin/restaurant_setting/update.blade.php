@extends('admin.layouts.master')
@section('title')
    Restaurant Setting
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css')}}">
@endsection

@section('content')
    <div class="page-inner-content">
        <div class="row no-gutters">
            <!--================================-->
            <!-- Page Content Area Start -->
            <!--================================-->
            <div class="col-lg-12 page-content-area ">
                <div class="inner-content">
                    <form action="{{ route('admin.restaurant.postUpdate') }}" method="post" class="modal-body col-12" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$restaurant->id  }}">
                        <div class="col col-12  custom-fieldset">
                            <!--  status radio buttons -->
                            <div class="row">
                                <div class="col col-12 col-lg-12">
                                    <div class="form-check d-flex justify-content-end">
                                        <label class="form-check-label m-0" style="font-size: 13px ; padding: 6px 28px">
                                            <input type="radio"
                                                   class="form-check-input"
                                                   name="status"
                                                   value="0"
                                                   {{ old('status', $restaurant->status) == Config::get('const.food.status.Active') ? 'checked' : '' }}>
                                            Active
                                        </label>
                                        <label class="form-check-label m-0" style="font-size: 13px; padding: 6px 28px">
                                            <input type="radio"
                                                   class="form-check-input"
                                                   name="status"
                                                   value="1"
                                                   {{ old('status', $restaurant->status) == Config::get('const.food.status.Inactive') ? 'checked' : '' }}>
                                            Inactive
                                        </label>
                                    </div>
                                    <p class="w-100 error text-danger d-flex justify-content-end">{{ $errors->first('status') }}</p>
                                </div>
                            </div>
                            <!-- logo ,name input field -->
                            <div class="mb-4">
                                <div class="row d-flex flex-wrap">
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 col-md-6">Logo </div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <img class="profile-pic img-fluid rounded"
                                                src="{{ asset('storage/logo/' . $restaurant->logo) ?? '' }}">
                                            <input id="avatar-file" class="file-upload" name="logo" type="file"
                                                accept="image/*" />
                                            {{-- <input class="form-control w-100" name="logo"  type="file"  value="{{ old('logo', asset('storage/logo/' . $restaurant->logo) ?? '' ) }}" style="padding: 0.575rem 0.75rem 2px;"> --}}
                                            <p class="w-100 error text-danger">{{ $errors->first('logo') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 col-md-6">Name </div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $restaurant->name) }}">
                                            <p class="w-100 error text-danger">{{ $errors->first('name') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- name input field -->
                            <div class="mb-4">
                                <div class="row d-flex flex-wrap">
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 col-md-6">Start time </div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="flatpickr flatpickr-input form-control w-100" id="timeStartPicker"  name="start_time" type="text" value="{{ old('start_time', $restaurant->start_time) }}" placeholder="Select start time.." readonly="readonly">
                                            <p class="w-100 error text-danger">{{ $errors->first('start_time') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 col-md-6">End time</div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="flatpickr flatpickr-input form-control w-100" id="timeEndPicker"  name="end_time" type="text" value="{{ old('end_time', $restaurant->end_time) }}" placeholder="Select end time.." readonly="readonly">
                                            <p class="w-100 error text-danger">{{ $errors->first('end_time') }}</p>
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
                                            <input class="form-control w-100" name="email" id="email" type="email" value="{{ old('email', $restaurant->email) }}">
                                            <p class="w-100 error text-danger">{{ $errors->first('email') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 ">Address </div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="form-control w-100" name="address" id="address" type="text" value="{{ old('address', $restaurant->address) }}">
                                            <p class="w-100 error text-danger">{{ $errors->first('address') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Telephone input field -->
                            <div class="mb-4">
                                <div class="row d-flex flex-wrap">
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 ">Phone Number</div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="form-control w-100" name="phone" id="phone" type="tel" value="{{ old('phone', $restaurant->phone) }}">
                                            <p class="w-100 error text-danger">{{ $errors->first('phone') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 ">Maps</div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="form-control w-100" name="maps" id="maps" type="text" value="{{ old('maps', $restaurant->maps) }}">
                                            <p class="w-100 error text-danger">{{ $errors->first('maps') }}</p>
                                        </div>
                                    </div>
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
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr-active.js') }}"></script>

    <!-- END: Vendor JS-->
    <!-- BEGIN: Init JS-->
    <script>
        $(document).ready(function() {
            $('#timeStartPicker').flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });
            $('#timeEndPicker').flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });
        });
    </script>
@endsection
