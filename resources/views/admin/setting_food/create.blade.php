@extends('admin.layouts.master')
@section('title')
    Create Foods
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/swiper/css/swiper.min.css') }}">
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <style>
        .dz-progress {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="page-inner-content">
        <div class="row no-gutters">
            <!--================================-->
            <!-- Page Content Area Start -->
            <!--================================-->
            <div class="col-lg-12 page-content-area ">
                <div class="inner-content">
                    <form  class="modal-body col-12" id="myForm" >
                        {{-- @csrf --}}
                        <div class="col col-12  custom-fieldset">
                            <!-- Account status radio buttons -->
                            <div class="row">
                                <div class="col col-12 col-lg-12">
                                    <div class="form-check d-flex justify-content-end">
                                        <label class="form-check-label m-0" style="font-size: 13px ; padding: 6px 28px">
                                            <input type="radio" class="form-check-input" name="status" value="0"
                                                {{ old('status') == '0' ? 'checked' : '' }}>
                                            Active
                                        </label>
                                        <label class="form-check-label m-0" style="font-size: 13px; padding: 6px 28px">
                                            <input type="radio" class="form-check-input" name="status" value="1"
                                                {{ old('status') == '1' ? 'checked' : '' }}>
                                            Inactive
                                        </label>
                                    </div>
                                    <p class="w-100 error text-danger d-flex justify-content-end">
                                        {{ $errors->first('status') }}</p>
                                </div>
                            </div>
                            <!-- images input field -->
                            <div id="myDropzone" class="mb-4 dropzone"></div>

                            <!-- name input field -->
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col col-12 ">Food name</div>
                                    <div class="col col-12 col-lg-12 mt-2">
                                        <input class="form-control w-100" name="name" id="name" type="text" value="{{ old('name') }}">
                                        <p class="w-100 error text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Quantity and Price input field -->
                            <div class="mb-4">
                                <div class="row d-flex flex-wrap">
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 ">Quantity <span class="text-danger">*</span></div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="form-control w-100" name="quantity" id="quantity" type="number"
                                                value="{{ old('quantity') }}">
                                            <p class="w-100 error text-danger">{{ $errors->first('quantity') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 p-0 m-0">
                                        <div class="col col-12 ">Price </div>
                                        <div class="col col-12 col-lg-12 mt-2">
                                            <input class="form-control w-100" name="price" id="price" type="number"
                                                value="{{ old('price') }}">
                                            <p class="w-100 error text-danger">{{ $errors->first('price') }}</p>
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
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <script>
        // Khởi tạo Dropzone
        Dropzone.autoDiscover = false;
        // Cấu hình Dropzone
        var myDropzone = new Dropzone("#myDropzone", {
            url: "dummy-url", // Dummy URL or any valid URL
            acceptedFiles: 'image/*',
            maxFiles: 10,
            dictDefaultMessage: "Drag and drop photos here or click to upload",
            dictInvalidFileType: "Only image files are accepted",
            autoProcessQueue: false, // Tắt chế độ tự động tải lên
            addRemoveLinks: true, // Hiển thị nút xóa
            // dictRemoveFile: "Xóa",
        });

        $('#myForm').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            // Add image files to the form data
            $.each(myDropzone.files, function(index, file) {
                formData.append('images[]', file);
            });
            // Send the form data using AJAX
            $.ajax({
                url: "{{ route('admin.setting_food.postCreate') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    // window.location.href = ;
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>

@endsection
