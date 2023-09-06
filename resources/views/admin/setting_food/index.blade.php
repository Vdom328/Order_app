@extends('admin.layouts.master')
@section('title')
    List Setting Food
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/swiper/css/swiper.min.css') }}">
    @vite([
        'resources/css/admin/setting_food.css',
    ])
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
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
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $foods as $food )
                                            <tr>
                                                <td class="images_food">
                                                    <div data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                                                        <div><h3>1</h3></div>
                                                        <div><h3>2</h3></div>
                                                        <div><h3>3</h3></div>
                                                        <div><h3>4</h3></div>
                                                        <div><h3>5</h3></div>
                                                        <div><h3>6</h3></div>
                                                      </div>

                                                    <button class="prev-btn">Prev</button>
                                                    <button class="next-btn">Next</button>

                                                </td>
                                                <td class="pl-4">{{ $food->name }}</td>
                                                <td class="pl-4">{{ $food->quantity }}</td>
                                                <td class="pl-4">{{ number_format($food->price) }}</td>
                                                <td class="pl-4">{{ $food->status }} </td>
                                                <td class=" text-center ">
                                                    <a href="" class="table-action  mg-r-10" href="#"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a data-id="" class="table-action " id="deleteUser" data-toggle="modal"
                                                        data-target="#deleteModal"><i class="fa fa-trash"></i></a>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- END: Vendor JS-->
    <!-- BEGIN: Init JS-->
    <script>
        $(document).ready(function() {
            $(".slider").slick({

// normal options...
infinite: false,

// the magic
responsive: [{

    breakpoint: 1024,
    settings: {
      slidesToShow: 3,
      infinite: true
    }

  }, {

    breakpoint: 600,
    settings: {
      slidesToShow: 2,
      dots: true
    }

  }, {

    breakpoint: 300,
    settings: "unslick" // destroys slick

  }]
});
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
