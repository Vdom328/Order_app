@extends('admin.layouts.master')
@section('title')
    Restaurant Food Setting
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
    <link type="text/css" href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
    <style>
        label {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="page-inner-content">
        <div class="row no-gutters">
            <div class="col-lg-12 page-content-area">
                <form method="post" action="{{ route('admin.restaurant_food.postFoodRestaurant') }}" class="inner-content">
                    @csrf
                    <div class="col-12 d-flex justify-content-end p-0">
                        <div class="col-3">
                            <select class="selectpicker form-control" name="restaurant_id" id="restaurant_id">
                                @foreach ($restaurant as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3" id="option_meals">
                            <select class="selectpicker form-control" name="type_maeal" id="type_meal" disabled>

                            </select>
                        </div>
                    </div>
                    <div class="custom-fieldset-style mg-b-30 mt-3">
                        <div class="clearfix">
                            <div class="clearfix">
                                <div class="col-12 d-flex flex-wrap" id="list_foods">

                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success waves-effect mt-3" id="submitForm">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            getResstaurantMeals();
            $(document).on('change', '#restaurant_id', function() {
                getResstaurantMeals();
            });

            // call ajax get meal by restaurant id
            function getResstaurantMeals() {
                $('#option_meals').html('');
                $.ajax({
                    url: "{{ route('admin.restaurant_food.getMeals') }}",
                    type: 'get',
                    data: {
                        restaurant_id: $('#restaurant_id').val(),
                    },
                    success: function(data) {
                        $('#option_meals').html(data.data);
                        option_meals();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $.growl.error({
                            message: 'An error occurred, please try again !'
                        });
                    },
                });
            }

            // call checkbox foood restaurant by restaurant id
            $(document).on('change', '#type_meal', function() {
                option_meals();
            });
            function option_meals(){
                $('#list_foods').html('');
                $.ajax({
                    url: "{{ route('admin.restaurant_food.getCheckbox') }}",
                    type: 'get',
                    data: {
                        type_meal: $('#type_meal').val(),
                    },
                    success: function(data) {
                        console.log(data);
                        $('#list_foods').html(data.data);
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
