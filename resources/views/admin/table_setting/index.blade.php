@extends('admin.layouts.master')
@section('title')
    Restaurant Tables Setting
@endsection
@section('css')

@endsection

@section('content')
    <div class="page-inner-content">
        <div class="row no-gutters">
            <div class="col-lg-12 page-content-area">
                <div class="inner-content">
                    <div class="col-12 d-flex justify-content-end p-0">
                        <div class="col-3">
                            <select class="selectpicker form-control" name="restaurant_id" id="restaurant_id">
                                @foreach ($list_restaurant as $item)
                                    <option value="{{ $item->id }}" @if ($restaurant->id == $item->id) selected @endif>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="custom-fieldset-style mg-b-30 mt-3">
                        <div class="clearfix">
                            <div class="clearfix">
                                <div class="col-12 d-flex flex-wrap" id="list_table">
                                    @for ($i = 0; $i < $restaurant->quantity_table ; $i++)
                                        @php
                                            $tableExists = collect($restaurant->restaurant_table)->contains('table_id', $i + 1);
                                        @endphp
                                        <div class="col-xl-2 col-md-3 col-6 mt-3 mt-md-5 d-flex p-0">
                                            <div class="col-6 p-0">
                                                <img src="{{ asset('images/meeting' . ($tableExists ? '-active' : '') . '.png') }}" alt="" width="100%">
                                            </div>
                                            <div class="col-6 d-flex flex-wrap align-items-center">
                                                <div class="fw-bold">Table: {{ $i + 1 }}</div>
                                                <div>Status: </div>
                                                <button type="button" class="btn btn-{{ $tableExists ? 'info' : 'success' }} btn-icon {{ $tableExists ? 'show-qr' : 'create-qr' }}" data-table-id="{{ $i + 1 }}">
                                                    <div><i class="fa fa-qrcode"></i></div>
                                                </button>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modal-show">

    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.create-qr', function() {
                $.ajax({
                        url: "{{ route('admin.table.createQrCode') }}",
                        type: 'get',
                        data: {
                            table_id: $(this).attr('data-table-id'),
                            restaurant_id: $('#restaurant_id').val()
                        },
                        success: function(data) {
                            window.location.href = "{{ route('admin.listTable') }}?restaurant_id=" + $('#restaurant_id').val() ;
                        },
                    });
            });

            // click show qr
            $(document).on('click', '.show-qr', function() {
                $.ajax({
                        url: "{{ route('admin.table.showQrCode') }}",
                        type: 'get',
                        data: {
                            table_id: $(this).attr('data-table-id'),
                            restaurant_id: $('#restaurant_id').val()
                        },
                        success: function(data) {
                            $('#modal-show').html(data);
                            $('#show-qr').modal('show');
                        },
                    });
            });

            $(document).on('change', '#restaurant_id', function() {
                let restaurant_id = $('#restaurant_id').val();
                window.location.href = "{{ route('admin.listTable') }}?restaurant_id=" + restaurant_id ;
            })
        });
    </script>
@endsection
