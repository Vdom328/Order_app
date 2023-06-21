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
                                <table id="basicDataTable" class="table table-bordered responsive nowrap hover table-striped">
                                    <thead >
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
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                       <img class="wd-35 rounded-circle img-fluid" src="{{ asset('storage/' . $user->avatar)}}" alt="">
                                                       <div class="mg-l-10">
                                                          <p class="lh-1 mg-0">{{ $user->last_name && $user->first_name ? $user->last_name . ' ' . $user->first_name : 'User name' }}</p>
                                                          <small class="">{{ $user->role_name }}</small>
                                                       </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="{{ $user->account_status == 1 ? 'status-active' : 'status-inactive' }}">
                                                    {{ $user->account_status == 1 ? 'Active' : 'Inactive' }}
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->telephone ?? ''}}</td>
                                                <td>{{ $user->account_status == 1 ? 'Male' : 'Female' }}</td>
                                                <td class=" text-center">
                                                    <a href="{{ route('admin.user.getProfile',$user->id) }}" class="table-action  mg-r-10" href="#"><i class="fa fa-pencil"></i></a>
                                                    <a class="table-action " href="#"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot >
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
            $("#submitForm").on("click", function() {
                $("#myForm").attr("method", "post");
                $("#myForm").attr("action", "{{ route('admin.user.postCreate') }}");
                $("#myForm").submit();
            });
        });
    </script>
@endsection
