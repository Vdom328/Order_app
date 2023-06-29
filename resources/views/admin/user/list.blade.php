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
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr id="user-{{ $user->id }}">
                                                <td>
                                                    <div class="d-flex">
                                                        @if ($user->avatar)
                                                            <img class="wd-35 rounded-circle img-fluid" src="{{ asset('storage/' . $user->avatar) }}" alt="">
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
                                                    class="{{ $user->account_status == 1 ? 'status-active' : 'status-inactive' }}">
                                                    {{ $user->account_status == 1 ? 'Active' : 'Inactive' }}
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->telephone ?? '' }}</td>
                                                <td>{{ $user->account_status == 1 ? 'Male' : 'Female' }}</td>
                                                <td class=" text-center">
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
    {{-- modal delete  --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModal">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" id="confirmDeleteBtn" data-id="#"
                        class="btn btn-primary waves-effect">Delete</button>
                </div>
            </div>
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

            // active menu items
            $('.user').addClass('open active');
            $('.sub-menu').css('display', 'block');
            $('.list_user').addClass('active');
            // add User
            $(document).on('click', '#deleteUser', function() {
                var id = $(this).attr('data-id');
                console.log(id);
                var deleteUrl = "{{ route('admin.user.delete', ['id' => ':id']) }}".replace(':id', id);
                $("#deleteModal").modal("show");
                $("#confirmDeleteBtn").on("click", function(event) {
                    event.preventDefault();
                    myAjaxCall(deleteUrl, 'POST', {},
                        function(data) {
                            $('#user-' + data.id).hide();
                            $("#deleteModal").modal("hide");
                        },
                        function(errorResponse) {
                            // Xử lý errorResponse khi lỗi
                        },
                        'Delete user successfully !',
                        'An error occurred, please try again !'
                    )
                });
            });

        });
    </script>
@endsection
