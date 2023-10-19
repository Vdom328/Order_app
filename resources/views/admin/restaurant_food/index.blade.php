@extends('admin.layouts.master')
@section('title')
    Restaurant Food Setting
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">
    <link type="text/css" href="{{ asset('assets/plugins/dataTable/extensions/dataTables.jqueryui.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}">
    <style>
        label {
            margin-bottom: 0;
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
                    <div class="col-12 d-flex justify-content-end p-0">
                        <div class="col-3">
                            <select class="selectpicker form-control" name="restaurant_id">
                                @foreach ($restaurant as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <select class="selectpicker form-control" name="">
                                <option value="">Buwax Truwa</option>
                            </select>
                        </div>
                    </div>
                    <div class="custom-fieldset-style mg-b-30 mt-3">
                        <div class="clearfix">
                            <div class="clearfix">
                                <div class="col-12 d-flex flex-wrap">
                                    @foreach ( $foods as $food )
                                        <div class="col-3 p-2 d-flex align-items-center">
                                            <input type="checkbox" name="food_id[]" class="form-check-input mb-1" id="food_{{ $food->id }}" value="{{ $food->id }}"><label for="food_{{ $food->id }}" class="pl-2">{{ $food->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
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
    @include('modals.delete')
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
@endsection
