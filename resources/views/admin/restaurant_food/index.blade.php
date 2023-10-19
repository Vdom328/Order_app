@extends('admin.layouts.master')
@section('title')
    Restaurant Food Setting
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
    <link type="text/css" href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}">
    <style>
        label {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="page-inner-content">
        <div class="row no-gutters">
            <!--================================-->
            <!-- Page Content Area Start -->
            <!--================================-->

            <!--/ Page Content Area End -->
            <!--================================-->
        </div>
    </div>
    <div class="col-lg-12 page-content-area">
        <div class="inner-content">
            <div class="col-12 d-flex justify-content-end p-0">
                <div class="col-3">
                    <select class="selectpicker form-control" name="restaurant_id" id="restaurant_id">
                        <option value="">Please select</option>
                        @foreach ($restaurant as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <select class="selectpicker form-control" name="type_maeal" id="type_meal">
                        @foreach ($typeMeals as $typeMeal)
                            <option value="{{ $typeMeal['value'] }}">{{ $typeMeal['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="custom-fieldset-style mg-b-30 mt-3">
                <div class="clearfix">
                    <div class="clearfix">
                        <div class="col-12 d-flex flex-wrap">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '#restaurant_id', function() {
                getResstaurantMeals();
            });

            // call ajax get meal by restaurant id
            function getResstaurantMeals() {
                $.ajax({
                    url: "{{ route('admin.restaurant_food.getMeals') }}",
                    type: 'get',
                    data: {
                        restaurant_id: $('#restaurant_id').val(),
                        type_meal: $('#type_meal').val(),
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $.growl.error({
                            message: 'An error occurred, please try again !'
                        });
                    },
                });
            }
        });
    </script>
@endsection
