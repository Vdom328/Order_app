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
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="custom-fieldset-style mg-b-30 mt-3">
                        <div class="clearfix">
                            <div class="clearfix">
                                <div class="col-12 d-flex flex-wrap" id="list_table">
                                    @for ($i = 0; $i < $restaurant->quantity_table ; $i++)
                                        <div class="col-xl-2 col-md-3 col-6 mt-3 mt-md-5 d-flex p-0">
                                            <div class="col-6 p-0">
                                                {{-- @foreach ( $restaurant->restaurant_table as $restaurant_table )
                                                    @if ($restaurant_table == ($i + 1)) --}}
                                                        <img src="{{ asset('images/meeting-active.png') }}" alt="" width="100%">
                                                        {{-- @continue;
                                                    @endif
                                                @endforeach --}}
                                            </div>
                                            <div class="col-6 d-flex flex-wrap align-items-center">
                                                <div class="fw-bold">Table: {{ $i + 1 }}</div>
                                                <div>Status: </div>
                                                <button>Qr Code</button>
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
@endsection
@section('js')
    <script>
        $(document).ready(function() {
        });
    </script>
@endsection
