@extends('admin.layouts.master')
@section('title')
    List Role
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
                    <div class="col-12 d-flex justify-content-end p-0">
                        <button type="button" class="btn btn-primary waves-effect mb-3" data-toggle="modal"
                            data-target="#addRole">
                            Add Role
                        </button>
                    </div>
                    <div class="custom-fieldset-style mg-b-30">
                        <div class="clearfix">
                            <div class="clearfix">
                                <table id="basicDataTable"
                                    class="table table-bordered responsive nowrap hover table-striped">
                                    <thead>
                                        <tr>
                                            <th class="col-1">#</th>
                                            <th>Name</th>
                                            <th class="col-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td class=" text-center">
                                                    <a class="table-action edit_role  mg-r-10"
                                                        data-id={{ $role->id }}><i class="fa fa-pencil"></i></a>
                                                    <a data-id="{{ $role->id }}"
                                                        class="table-action" id="deleteRole" data-toggle="modal"
                                                        data-target="#deleteModal"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
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
    {{-- modal add role --}}
    <div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="ModalRole" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalRole">Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="myForm" class="col-12 col-md-12 p-0 m-0">
                        @csrf
                        <div class="col col-12 col-md-12">Name Role</div>
                        <div class="col col-12 col-lg-12 mt-2">
                            <input class="form-control w-100" name="name" id="name" type="text"
                                value="{{ old('name') }}">
                            <p class="w-100 error text-danger">{{ $errors->first('name') }}</p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" id="submitForm" data-id="#" class="btn btn-primary waves-effect">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal delete role --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModal">Role</h5>
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
            $('.list_role').addClass('active');
            // add User
            $("#submitForm").on("click", function() {
                $("#myForm").attr("method", "post");
                $("#myForm").attr("action", "{{ route('admin.role.postCreate') }}");
                $("#myForm").submit();
            });
            // edit role
            $(document).on('click', '.edit_role', function() {
                $('#addRole').modal('show');
                var id = $(this).attr('data-id');
                $('#submitForm').attr('data-id', id);
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.role.getEditRole', ['id' => ':id']) }}".replace(':id',
                        id),
                    data: {},
                    success: function(data) {
                        $("#name").val(data.name);
                        // posst edit User
                        $("#submitForm").on("click", function() {
                            $("#myForm").attr("method", "post");
                            $("#myForm").attr("action",
                                "{{ route('admin.role.postCreate', ['id' => ':id']) }}"
                                .replace(':id', id));
                            $("#myForm").submit();
                        });
                    },
                    error: function(error) {
                        alert(error.responseJSON.error);
                    }
                });
            });
            $(document).on('click', '#deleteRole', function() {
                var id = $(this).attr('data-id');
                console.log(id);
                var deleteUrl = "{{ route('admin.role.deleteRole', ['id' => ':id']) }}".replace(':id', id);
                $("#deleteModal").modal("show");
                $("#confirmDeleteBtn").on("click", function() {
                    window.location.href = deleteUrl;
                });
            });
        });
    </script>
@endsection
