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
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->code }}</td>
                                                <td>{{ $order->user->first_name}} {{ $order->user->last_name}}</td>
                                                <td>Table: {{ $order->table_id}}</td>
                                                <td>{{$order->restaurant->name  }}</td>
                                                <td>{{$order->time_order  }}</td>
                                                <td>{{PaymentOrderEnum::getLabel($order->payment)  }}</td>
                                                <td>{{StatusOrderEnum::getLabel($order->status)  }}</td>
                                                <td></td>
                                                <td></td>
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

        });
    </script>
@endsection
