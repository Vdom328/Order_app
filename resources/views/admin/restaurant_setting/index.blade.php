@extends('admin.layouts.master')
@section('title')
    List Restaurant
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
    <style>
        a:hover {
            cursor: pointer;
            color: #5c76fb;
        }
    </style>
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
                                    class="table table-bordered responsive nowrap hover table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Name</th>
                                            <th>Start time</th>
                                            <th>End time</th>
                                            <th>Maps</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $restaurants as $restaurant )
                                            <tr>
                                                <td>
                                                        @if ($restaurant->logo)
                                                            <img class="wd-35  rounded-circle" src="{{ asset('storage/logo/' . $restaurant->logo) }}" alt="" height="35px">
                                                        @else
                                                            <img class="wd-35 rounded-circle " src="{{ asset('images/th (3).jpg') }}" alt="" height="35px">
                                                        @endif
                                                </td>
                                                <td>{{ $restaurant->name }}</td>
                                                <td>{{ $restaurant->start_time }}</td>
                                                <td>{{ $restaurant->end_time }}</td>
                                                <td>{{ $restaurant->maps }}</td>
                                                <td class=" text-center ">
                                                    <a href="{{ route('admin.restaurant.update', $restaurant->id) }}"
                                                        class="table-action  mg-r-10"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a data-id="{{ $restaurant->id }}" class="table-action " id="deleteRestaurant"
                                                        data-toggle="modal" data-target="#deleteModal"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>logo</th>
                                            <th>Name</th>
                                            <th>Start time</th>
                                            <th>End time</th>
                                            <th>Maps</th>
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
    @include('modals.delete')
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
            // add User
            $(document).on('click', '#deleteRestaurant', function() {
                var id = $(this).attr('data-id');
                var deleteUrl = "{{ route('admin.restaurant.delete', ['id' => ':id']) }}".replace(':id', id);
                $("#deleteModal").modal("show");
                $("#confirmDeleteBtn").on("click", function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        success: function(data) {
                            window.location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $.growl.error({
                                message: 'An error occurred, please try again !'
                            });
                        },
                    });
                });
            });

        });
    </script>
@endsection
