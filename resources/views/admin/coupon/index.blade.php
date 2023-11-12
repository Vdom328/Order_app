@php
    use App\Classes\Enum\CouponTypeEnum;
@endphp
@extends('admin.layouts.master')
@section('title')
    Restaurant Coupon
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
@endsection

@section('content')
    <div class="page-inner-content">
        <div class="row no-gutters">
            <div class="col-lg-12 page-content-area">
                <div class="inner-content">
                    <div class="col-12 custom-fieldset-style mg-b-30 mt-3 bg-white " id="form-coupon">
                        <div class="col-12 d-flex flex-wrap">
                            <div class="col-3">
                                <label for="">Code</label>
                                <input type="text" name="code" class="form-control" placeholder="Code">
                            </div>
                            <div class="col-3">
                                <label for="">Percent</label>
                                <div class="d-flex">
                                    <input type="radio" name="type" value="{{ CouponTypeEnum::PERCENT->value }}">
                                    <input type="number" name="percent" class="form-control ml-4" placeholder="Percent">
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="">Price</label>
                                <div class="d-flex">
                                    <input type="radio" name="type" value="{{ CouponTypeEnum::PRICE->value }}">
                                    <input type="number" name="price" class="form-control ml-4" placeholder="Price">
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="">Enabled/Disabled</label>
                                <div class="custom-control custom-switch d-flex align-items-center ml-2">
                                    <input type="checkbox" class="custom-control-input form-control" name="status_coupon"
                                        id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-wrap mt-3">
                            <div class="col-12">
                                <label for="">Memo:</label>
                                <textarea name="memo" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-12  d-flex justify-content-end">
                                <button type="button" class="btn btn-success waves-effect mt-3"
                                    id="submitForm">Save</button>
                            </div>
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
                                            <th>Status</th>
                                            <th>Memo</th>
                                            <th>Type</th>
                                            <th>Value</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="list_coupon">
                                        @include('admin.coupon.partials._list')
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Code</th>
                                            <th>Status</th>
                                            <th>Meno</th>
                                            <th>Type</th>
                                            <th>Value</th>
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
    <div id="modal-edit">

    </div>
    @include('modals.delete')
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

            // Initially, disable both inputs

            $("input[name='percent'], input[name='price']").prop("disabled", true);

            // Enable/disable inputs based on radio button selection
            $(document).on('change', "input[name='type']", function() {
                if ($(this).val() === "0") {
                    $("input[name='percent']").prop("disabled", false);
                    $("input[name='price']").prop("disabled", true);
                } else if ($(this).val() === "1") {
                    $("input[name='percent']").prop("disabled", true);
                    $("input[name='price']").prop("disabled", false);
                }
            });

            // click update coupon
            $(document).on("click", "#submitForm", function() {
                var formData = {
                    code: $("input[name='code']").val(),
                    type: $("input[name='type']:checked").val(),
                    percent: $("input[name='percent']").val(),
                    price: $("input[name='price']").val(),
                    memo: $("textarea[name='memo']").val(),
                    status_coupon: $("input[name='status_coupon']").prop("checked") ? 1 : 0
                };
                updateCoupon(formData)
            });

            // click delete coupon button
            $(document).on('click', '#delete-coupon', function() {
                var id = $(this).attr('data-id');
                var deleteUrl = "{{ route('admin.coupons.delete', ['id' => ':id']) }}".replace(':id',
                    id);
                $("#confirmDeleteBtn").on("click", function() {
                    window.location.href = deleteUrl;
                });
            });

            // click edit coupon
            $(document).on('click', '.edit_coupon', function() {
                let id = $(this).attr('data-id');
                $('#modal-edit').html('');
                $.ajax({
                    url: "{{ route('admin.coupons.edit') }}",
                    type: 'get',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#modal-edit').html(data);
                        $('#edit-coupon').modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {},
                });
            })

            // submit edit coupon
            $(document).on('click', '#submit-form-edit-coupon', function() {
                var formData = {
                    id: $("input[name='id-edit']").val(),
                    code: $("input[name='code-edit']").val(),
                    type: $("input[name='type-edit']:checked").val(),
                    percent: $("input[name='percent-edit']").val(),
                    price: $("input[name='price-edit']").val(),
                    memo: $("textarea[name='memo-edit']").val(),
                    status_coupon: $("input[name='status_coupon-edit']").prop("checked") ? 1 : 0
                };
                updateCoupon(formData)
            });

            // function update coupon
            function updateCoupon(formData)
            {
                $.ajax({
                    url: "{{ route('admin.coupons.create') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#edit-coupon').modal('hide');
                        if (response) {
                            $('#list_coupon').html(response);
                            $.growl.success({
                                message: "Create coupon successfully !"
                            });

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
    </script>
@endsection
