@extends('admin.layouts.master')
@section('title')
    List User
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
    <style>
        .status-active {
            color: green;
        }

        .status-inactive {
            color: red;
        }

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
                                    class="table table-bordered responsive nowrap hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Account status</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>Gender</th>
                                            <th>Right Rank</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr id="user-{{ $user->id }}">
                                                <td class="pl-4">
                                                    <div class="d-flex">
                                                        @if ($user->avatar)
                                                            <img class="wd-35 rounded-circle img-fluid" src="{{ asset('avatar/storage/' . $user->avatar) }}" alt="">
                                                        @else
                                                            <img class="wd-35 rounded-circle img-fluid" src="{{ asset('images/th (3).jpg') }}" alt="">
                                                        @endif
                                                        <div class="mg-l-10">
                                                            <p class="lh-1 mg-0">
                                                                {{ $user->last_name && $user->first_name ? $user->last_name . ' ' . $user->first_name : 'User name' }}
                                                            </p>
                                                            <small class="">{{ $user->role_name }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="{{ $user->account_status == 1 ? 'status-active' : 'status-inactive' }} pl-4">
                                                    {{ $user->account_status == config('const.user.account_status.Active') ? 'Active' : 'Inactive' }}
                                                </td>
                                                <td class="pl-4">{{ $user->email }}</td>
                                                <td class="pl-4">{{ $user->telephone ?? '' }}</td>
                                                <td class="pl-4">{{ $user->gender == config('const.user.gender.Male') ? 'Male' : 'Female' }}</td>
                                                <td class="pl-4">{{ $user->role->name }}</td>
                                                <td class=" text-center ">
                                                    <a href="{{ route('admin.user.getProfile', $user->id) }}"
                                                        class="table-action  mg-r-10" href="#"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a data-id="{{ $user->id }}" class="table-action " id="deleteUser"
                                                        data-toggle="modal" data-target="#deleteModal"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>User</th>
                                            <th>Account status</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>Gender</th>
                                            <th>Right Rank</th>
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
            $(document).on('click', '#deleteUser', function() {
                var id = $(this).attr('data-id');
                var deleteUrl = "{{ route('admin.user.delete', ['id' => ':id']) }}".replace(':id', id);
                $("#deleteModal").modal("show");
                $("#confirmDeleteBtn").on("click", function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        success: function(data) {
                            $('#user-' + data.id).hide();
                            $("#deleteModal").modal("hide");
                            $.growl.success({
                                message: 'Delete user successfully !'
                            });
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
