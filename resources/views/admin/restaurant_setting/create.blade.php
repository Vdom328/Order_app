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
                        <input type="hidden" name="id" value="">
                        <div class="col col-12  custom-fieldset">
                            <!--  status radio buttons -->
                            <div class="row">
                                <div class="col col-12 col-lg-12">
                                    <div class="form-check d-flex justify-content-end">
                                        <label class="form-check-label m-0" style="font-size: 13px ; padding: 6px 28px">
                                            <input type="radio"
                                                   class="form-check-input"
                                                   name="status"
                                                   value="1"
                                                   {{ old('status') == '1' ? 'checked' : '' }}>
                                            Active
                                        </label>
                                        <label class="form-check-label m-0" style="font-size: 13px; padding: 6px 28px">
                                            <input type="radio"
                                                   class="form-check-input"
                                                   name="status"
                                                   value="2"
                                                   {{ old('status') == '2' ? 'checked' : '' }}>
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
                                            <input class="form-control w-100" name="logo" id="logo" type="file"  value="{{ old('logo') }}" style="padding: 0.575rem 0.75rem 2px;">
                                            <p class="w-100 error text-danger">{{ $errors->first('logo') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 col-md-6">Name </div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
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
                                            <input class="flatpickr flatpickr-input form-control w-100" id="timeStartPicker"  name="start_time" type="text" value="{{ old('start_time') }}" placeholder="Select start time.." readonly="readonly">
                                            <p class="w-100 error text-danger">{{ $errors->first('start_time') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 col-md-6">End time</div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="flatpickr flatpickr-input form-control w-100" id="timeEndPicker"  name="end_time" type="text" value="{{ old('end_time') }}" placeholder="Select end time.." readonly="readonly">
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
                                            <input class="form-control w-100" name="email" id="email" type="email" value="{{ old('email') }}">
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
                            <!-- Telephone input field -->
                            <div class="mb-4">
                                <div class="row d-flex flex-wrap">
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 ">Phone Number</div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="form-control w-100" name="phone" id="phone" type="tel" value="{{ old('phone') }}">
                                            <p class="w-100 error text-danger">{{ $errors->first('phone') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 ">Maps</div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="form-control w-100" name="maps" id="maps" type="text" value="{{ old('maps') }}">
                                            <p class="w-100 error text-danger">{{ $errors->first('maps') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row d-flex flex-wrap">
                                    <div class="col-12 col-md-12 p-0 m-0">
                                        <div class="col col-12 ">Meal</div>
                                        <div class="col col-12 col-lg-12 mt-2 d-flex flex-wrap">
                                            @foreach ( $typeMeals as $typeMeal)
                                                <div class="custom-control custom-checkbox col-2 pl-4 mt-5">
                                                    <input type="checkbox" name="meal[]" class="custom-control-input" id="{{ $typeMeal['value'] }}" value="{{ $typeMeal['value'] }}">
                                                    <label class="custom-control-label" for="{{ $typeMeal['value'] }}">{{ $typeMeal['name'] }}</label>
                                                 </div>
                                            @endforeach
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
