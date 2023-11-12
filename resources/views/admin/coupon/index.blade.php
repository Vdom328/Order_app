@extends('admin.layouts.master')
@section('title')
    Restaurant Coupon
@endsection
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
@endsection

@section('content')

<div class="page-inner-content">
    <div class="row no-gutters">
        <div class="col-lg-12 page-content-area">
            <div class="inner-content">
                <div class="col-12 custom-fieldset-style mg-b-30 mt-3 bg-white d-flex flex-wrap">
                    <div class="col-3">
                        <label for="">Code</label>
                        <input type="text" name="code" class="form-control" placeholder="Code">
                    </div>
                    <div class="col-3">
                        <label for="">Percent</label>
                        <div class="d-flex">
                            <input type="radio" name="type" value="0" >
                            <input type="text" name="percent" class="form-control ml-4" placeholder="Percent">
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="">Price</label>
                        <div class="d-flex">
                            <input type="radio" name="type" value="1" >
                            <input type="text" name="price" class="form-control ml-4" placeholder="Price">
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="">Enabled/Disabled</label>
                        <div class="custom-control custom-switch d-flex align-items-center ml-2">
                            <input type="checkbox" class="custom-control-input form-control"
                            name="status_coupon" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1"></label>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success waves-effect mt-3" id="submitForm">Save</button>
                    </div>
                </div>

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
                                        <th>Total price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="list_order">
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
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
                                        <th>Total price</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{ asset('assets/plugins/dataTable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dataTable/responsive/dataTables.responsive.js') }}"></script>
<script src="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.js') }}"></script>
    <script>
        $(document).ready(function() {
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
