@extends('admin.layouts.master')
@section('title')
    List Orders
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
    <style>
        .pain-food {
            background: antiquewhite !important;
        }

        .pending-food {
            background: rgb(177 249 189) !important;
        }

        .btn {
            font-size: 13px !important;
        }
    </style>
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@endsection

@section('content')
    <div class="page-inner-content">
        <div class="row no-gutters">
            <!--================================-->
            <!-- Page Content Area Start -->
            <!--================================-->
            <div class="col-lg-12 page-content-area">
                <div class="inner-content">
                    <div class="col-12 d-flex justify-content-end p-0">
                        <button type="button" class="btn btn-primary waves-effect mb-3" id="new_order">
                            New Order
                        </button>
                    </div>
                    <div class="col-12 d-flex  p-0 mb-2">
                        <div class="col-2 pl-0">
                            <div class="font-weight-bold">Retaurant:</div>
                            <select name="restaurant_id" id="filter_restaurant"class="form-control">
                                <option value=""></option>
                                @foreach ($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2" id="option_meals">
                            <div class="font-weight-bold">Status:</div>
                            <select name="status" id="filter_status" class="form-control">
                                <option value=""></option>
                                @foreach ($status as $item)
                                    <option value="{{ $item['value'] }}" >
                                        {{ $item['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2 pl-0">
                            <div class="font-weight-bold">Date:</div>
                            <div class="form-control-wrapper">
                                <input type="text" id="date" class="form-control floating-label" placeholder="Date">
                            </div>
                        </div>
                        <div class="col-2 pl-0">
                            <div class="font-weight-bold"></div>
                            <button type="button" class="btn btn-info btn-icon mt-4" id="search_order">
                                <div><i class="fa fa-search"></i></div>
                            </button>
                        </div>
                    </div>
                    <div class="custom-fieldset-style mg-b-30">
                        <div class="clearfix">
                            <div class="clearfix">
                                <table id="basicDataTable"
                                    class="table table-bordered responsive nowrap hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>User name</th>
                                            <th>Table</th>
                                            <th>Restaurant</th>
                                            <th>Time</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th>Items</th>
                                            <th>Coupon</th>
                                            <th>Total price</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="list_order">
                                        @include('admin.orders.partials._list-order')
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Code</th>
                                            <th>User name</th>
                                            <th>Table</th>
                                            <th>Restaurant</th>
                                            <th>Time</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th>Items</th>
                                            <th>Coupon</th>
                                            <th>Total price</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Page Content Area End -->
            <!--================================-->
        </div>
    </div>
    <div id="modal-edit">

    </div>
    @include('admin.orders.partials._modal-create')
    @include('modals.delete')
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/dataTable/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dataTable/responsive/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/datetimepicker/js/datetimepicker-active.js') }}"></script>

    <!-- END: Vendor JS-->
    <!-- BEGIN: Init JS-->
    <script>
        $(document).ready(function() {
            $('#date').bootstrapMaterialDatePicker({ weekStart : 0, time: false });

            // Basic DataTable
            $('#basicDataTable').DataTable({
                responsive: true,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: ''
                }
            });

            $(document).on('click', '.edit_order', function() {
                let id = $(this).attr('data-id');
                $('#modal-edit').html('');
                $.ajax({
                    url: "{{ route('admin.order.getOrder') }}",
                    type: 'get',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#modal-edit').html(data.html);
                        $('#edit-order').modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {},
                });
            })

            // add new food ordes
            $(document).on('click', '#add-order-food', function() {
                let restaurant_id = $('.restaurant').val();
                addFoodToModal(function(food) {
                    $('#list-food-edit').append(food);
                }, restaurant_id);
            })

            // submit edit order
            $(document).on('click', '#submit-form-edit-order', function() {
                $('#form-edit-order').submit();
            });


            /******** New orders ********************************/
            // add new order food
            $(document).on('click', '#new_order', function() {
                $('#new-order').modal('show');
            })

            // change restaurant name
            $(document).on('change', '.restaurant', function() {
                $.ajax({
                    url: "{{ route('admin.order.changeRestaurant') }}",
                    type: 'get',
                    data: {
                        restaurant_id: $('.restaurant').val(),
                    },
                    success: function(data) {
                        $('#table-create-order').html(data.html);
                    },
                });
            })

            // click add food to creat new order
            $(document).on('click', '#add-food-new-order', function() {
                let restaurant_id = $('.restaurant').val();
                addFoodToModal(function(food) {
                    $('#list-fodd-add-new').append(food);
                }, restaurant_id);
            })

            function addFoodToModal(callback, restaurant_id) {
                let foodCount = $('.food_order').length;
                $.ajax({
                    url: "{{ route('admin.order.addOrderFood') }}",
                    type: 'get',
                    data: {
                        restaurant_id: restaurant_id,
                        foodCount: foodCount,
                    },
                    success: function(data) {
                        callback(data.html);
                    },
                });
            }

            $(document).on('click', '#submit-form-new-order', function() {
                $('#form-new-order').submit();
            });

            // delete order from
            $(document).on('click', '#delete-order', function() {
                var id = $(this).attr('data-id');
                var deleteUrl = "{{ route('admin.order.deleteOrder', ['id' => ':id']) }}".replace(':id',
                    id);
                $("#confirmDeleteBtn").on("click", function() {
                    window.location.href = deleteUrl;
                });
            });

            //search order
            $(document).on('click', '#search_order', function() {
                $.ajax({
                    url: window.location.href,
                    type: 'get',
                    data: {
                        restaurant_id: $('#filter_restaurant').val(),
                        status: $('#filter_status').val(),
                        date: $('#date').val(),
                    },
                    success: function(data) {
                        $('#list_order').html(data.html)
                    },
                });
            });
        });
    </script>
@endsection
