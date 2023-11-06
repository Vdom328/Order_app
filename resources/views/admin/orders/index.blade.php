@php
    use App\Classes\Enum\StatusOrderEnum;
    use App\Classes\Enum\PaymentOrderEnum;
@endphp
@extends('admin.layouts.master')
@section('title')
    List Orders
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
    <style>
        .pain-food{
            background: antiquewhite !important;
        }
        .pending-food{
            background: rgb(177 249 189) !important;
        }
        .btn{
            font-size: 13px !important;
        }
    </style>
    <link type="text/css" rel="stylesheet"
        href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
@endsection

@section('content')
    <div class="page-inner-content">
        <div class="row no-gutters">
            <!--================================-->
            <!-- Page Content Area Start -->
            <!--================================-->
            <div class="col-lg-12 page-content-area">
                <div class="inner-content">
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
                                            <th>Total price</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr class="@if ($order->status == StatusOrderEnum::PAID->value) pain-food @else pending-food @endif">
                                                <td class="font-weight-bold">#{{ $order->code }}</td>
                                                <td>{{ $order->user->first_name}} {{ $order->user->last_name}}</td>
                                                <td>Table: {{ $order->table_id}}</td>
                                                <td>{{$order->restaurant->name  }}</td>
                                                <td>{{$order->time_order  }}</td>
                                                <td>{{PaymentOrderEnum::getLabel($order->payment)  }}</td>
                                                <td>{{StatusOrderEnum::getLabel($order->status)  }}</td>
                                                <td>
                                                    @foreach ($order->order_food as $order_food)
                                                        <li>x{{ $order_food->quantity }} {{ $order_food->food_setting->name }}</li>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @php
                                                        $total_price = $order->order_food->reduce(function($carry, $item) {
                                                            return $carry + ($item->price * $item->quantity);
                                                        }, 0);
                                                    @endphp
                                                    {{ $total_price }}
                                                </td>
                                                <td>
                                                    <a class="table-action edit_order  mg-r-10"
                                                        data-id={{ $order->id }}><i class="fa fa-pencil"></i></a>
                                                    <a data-id="{{ $order->id }}"
                                                        class="table-action" id="deleteRole" data-toggle="modal"
                                                        data-target="#deleteModal"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
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
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/dataTable/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dataTable/responsive/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.js') }}"></script>
    <!-- END: Vendor JS-->
    <!-- BEGIN: Init JS-->
    <script>
        $(document).ready(function() {
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
                        console.log(data);
                        $('#modal-edit').html(data.html);
                        $('#edit-order').modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                    },
                });
            })
        });
    </script>
@endsection
