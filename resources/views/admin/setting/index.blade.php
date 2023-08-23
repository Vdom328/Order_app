@extends('admin.layouts.master')
@section('title')
 List Role
@endsection
@section('css')
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

@endsection
