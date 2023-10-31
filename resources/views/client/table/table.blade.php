@extends('client.layouts.master')

@section('css')
    @vite(['resources/css/client/order_now.css'])
    <style>
        .active-table {
            color: #8d7141
        }
    </style>
@endsection

@section('content')
    <div class="row">
        @for ($i = 0; $i < $restaurant->quantity_table; $i++)
            <div class="col-4 mt-4 table-food" data-table-id="{{ $i + 1 }}">
                <img src="{{ asset('images/meeting.png') }}" alt="" width="100%">
                <span class="fw-bold d-flex align-items-center justify-content-center">Table: {{ $i + 1 }}</span>
            </div>
        @endfor
    </div>
@endsection
@section('js')
@include('client.table.partials._modal')
    <script>
        $(document).ready(function() {
            activeTable()

            // click update table
            $(document).on("click", ".table-food", function() {
                const inforOrder = JSON.parse(localStorage.getItem('infor_order')) || [];

                const clickedTable = $(this);
                const clickedTableId = clickedTable.attr('data-table-id');
                if (clickedTableId == inforOrder.table_id) {
                    return;
                }
                $('.submit_save_table').attr('data-table-id', clickedTableId);
                $('#updateTableModal').modal('show');
            });

            $(document).on("click", ".submit_save_table", function() {
                const inforOrder = JSON.parse(localStorage.getItem('infor_order')) || [];
                let data_id = $(this).attr('data-table-id');
                // Update the table_id in the local storage
                inforOrder.table_id = data_id;
                localStorage.setItem('infor_order', JSON.stringify(inforOrder));
                // update rourouteHomete home
                let routeHome = '{{ route("client.home") }}?restaurant_id=' + inforOrder.restaurant_id + '&table_id=' + data_id;
                localStorage.setItem('route_home', JSON.stringify(routeHome));
                updateFoodTer();
                // active table
                activeTable();
            });

            function activeTable()
            {
                const inforOrder = JSON.parse(localStorage.getItem('infor_order')) || [];
                // active table
                let table = inforOrder.table_id;
                $('.table-food').removeClass('active-table');
                $('.table-food img').attr('src', '{{ asset("images/meeting.png") }}');

                $('.table-food').each(function() {
                    if ($(this).attr('data-table-id') == table) {
                        $(this).addClass('active-table');
                        $(this).find('img').attr('src', '{{ asset('images/meeting-active.png') }}');
                    }
                });


            }
        })
    </script>
@endsection
