@extends('admin.layouts.master')
@section('title')
    List Setting Food
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/swiper/css/swiper.min.css') }}">
    @vite(['resources/css/admin/setting_food.css'])
    <!-- CSS của Slick Slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@endsection

@section('content')
    <div class="page-inner-content">
        <div class="row no-gutters">
            <!--================================-->
            <!-- Page Content Area Start -->
            <!--================================-->
            <div class="col-lg-12 page-content-area">
                <div class="inner-content ">
                    {{-- <div class="row ">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select class="selectpicker form-control">
                                    <option>Mustard</option>
                                    <option>Ketchup</option>
                                    <option>Relish</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select class="selectpicker form-control">
                                    <option>Mustard</option>
                                    <option>Ketchup</option>
                                    <option>Relish</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select class="selectpicker form-control">
                                    <option>Mustard</option>
                                    <option>Ketchup</option>
                                    <option>Relish</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select class="selectpicker form-control">
                                    <option>Mustard</option>
                                    <option>Ketchup</option>
                                    <option>Relish</option>
                                </select>
                            </div>
                        </div>
                    </div> --}}
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="dishesOutOfStock">
                        <label class="custom-control-label pl-2 font-weight-bold" for="dishesOutOfStock">The dishes are out
                            of stock</label>
                    </div>
                </div>
                <div class="inner-content">
                    <div class="custom-fieldset-style mg-b-30 ">
                        <div class="clearfix">
                            <div class="clearfix">
                                <table id="basicDataTable"
                                    class="table table-bordered responsive nowrap hover table-striped">
                                    <thead>
                                        <tr>
                                            <th class="col-2">Images</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_table">
                                        @foreach ($foods as $food)
                                            <tr>
                                                <td class="images_food">
                                                    <div id="carousel-{{ $food->id }}" class="carousel slide"
                                                        data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                            @foreach ($food->foodImages as $index => $image)
                                                                <div
                                                                    class="carousel-item{{ $index == 0 ? ' active' : '' }}">
                                                                    <img src="{{ asset('storage/food_images/' . $image->image) }}"
                                                                        alt="" width="100%">
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <!-- Nút "prev" -->
                                                        <a class="carousel-control-prev"
                                                            href="#carousel-{{ $food->id }}" role="button"
                                                            data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon"
                                                                aria-hidden="true"></span>
                                                            <span class="visually-hidden">Previous</span>
                                                        </a>

                                                        <!-- Nút "next" -->
                                                        <a class="carousel-control-next"
                                                            href="#carousel-{{ $food->id }}" role="button"
                                                            data-bs-slide="next">
                                                            <span class="carousel-control-next-icon"
                                                                aria-hidden="true"></span>
                                                            <span class="visually-hidden">Next</span>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="pl-4">{{ $food->name }}</td>
                                                <td class="pl-4">{{ $food->quantity }}</td>
                                                <td class="pl-4">{{ number_format($food->price) }}</td>
                                                <td class="pl-4">
                                                    {{ $food->status == config('const.food.status.Active') ? 'Active' : 'Inactive' }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.setting_food.edit',$food->id) }}" class="table-action mg-r-10"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a data-id="{{$food->id }}" class="table-action" id="deleteFood"
                                                        data-toggle="modal" data-target="#deleteModal"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="col-2">Images</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Status</th>
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
    <script src="{{ asset('assets/plugins/swiper/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/swiper/js/swiper-active.js') }}"></script>
    <!-- JS của Bootstrap Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- BEGIN: Init JS-->

    <script>
        $(document).ready(function() {
            $('.carousel').carousel();
            // Basic DataTable
            $('#basicDataTable').DataTable({
                responsive: true,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: ''
                }
            });
            // call ajax
            $(document).on('change', '#dishesOutOfStock', function() {
                // Lấy trạng thái checkbox (true nếu được chọn, false nếu không)
                var isChecked = $(this).is(':checked');
                // Kiểm tra trạng thái của checkbox và gửi giá trị tương ứng thông qua Ajax
                $.ajax({
                    url: "{{ route('admin.setting_food.ajaxCheckbox') }}",
                    method: 'get',
                    data: {
                        outOfStock: isChecked
                    }, // Gửi giá trị true/false tùy thuộc vào trạng thái của checkbox
                    success: function(response) {
                        // Xử lý khi Ajax thành công
                        $('#tbody_table').html(response.data);
                    },
                    error: function(xhr, status, error) {
                        // Xử lý khi Ajax thất bại
                        console.error(error);
                    }
                });
            });
            // delete
            $(document).on('click', '#deleteFood', function() {
                var id = $(this).attr('data-id');
                var deleteUrl = "{{ route('admin.setting_food.delete', ['id' => ':id']) }}".replace(':id', id);
                $("#deleteModal").modal("show");
                $("#confirmDeleteBtn").on("click", function() {
                    window.location.href = deleteUrl;
                });
            });
        });
    </script>
@endsection
