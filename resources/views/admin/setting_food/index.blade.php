@extends('admin.layouts.master')
@section('title')
    List Projects
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/swiper/css/swiper.min.css') }}">
    @vite([
        'resources/css/admin/setting_food.css',
    ])
@endsection

@section('content')
    <div class="page-inner-content">
        <div class="row no-gutters">
            <!--================================-->
            <!-- Page Content Area Start -->
            <!--================================-->
            <div class="col-lg-12 page-content-area">
                <div class="inner-content ">
                    <div class="row ">
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
                    </div>
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
                                            <th>Ingredient</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="images_project">
                                                    <div class="swiper-container" id="fraction-pagination">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">Slide 1</div>
                                                            <div class="swiper-slide">Slide 2</div>
                                                            <div class="swiper-slide">Slide 3</div>
                                                            <div class="swiper-slide">Slide 4</div>
                                                            <div class="swiper-slide">Slide 5</div>
                                                            <div class="swiper-slide">Slide 6</div>
                                                            <div class="swiper-slide">Slide 7</div>
                                                            <div class="swiper-slide">Slide 8</div>
                                                            <div class="swiper-slide">Slide 9</div>
                                                            <div class="swiper-slide">Slide 10</div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="swiper-pagination"></div>
                                                        <!-- Add Arrows -->
                                                        <div class="swiper-button-next"></div>
                                                        <div class="swiper-button-prev"></div>
                                                    </div>
                                            </td>
                                            <td class="pl-4">

                                            </td>
                                            <td class="pl-4">Quansity</td>
                                            <td class="pl-4">Price</td>
                                            <td class="pl-4">
                                                <li></li>
                                                <li></li>
                                                <li></li>
                                                <li></li>
                                                <li></li>
                                                <li></li>
                                                <li></li>
                                            </td>
                                            <td class=" text-center ">
                                                <a href="" class="table-action  mg-r-10" href="#"><i
                                                        class="fa fa-pencil"></i></a>
                                                <a data-id="" class="table-action " id="deleteUser" data-toggle="modal"
                                                    data-target="#deleteModal"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="col-2">Images</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Ingredient</th>
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
    <!-- END: Vendor JS-->
    <!-- BEGIN: Init JS-->
    <script>
        // Basic DataTable
        $('#basicDataTable').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: ''
            }
        });
    </script>
@endsection
