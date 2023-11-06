<div class="modal fade" id="edit-order" tabindex="-1" role="dialog" aria-labelledby="ModalRole" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Orders</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm" class="col-12 col-md-12 p-0 m-0">
                    @csrf
                    <div class="col-12 d-flex justify-content-end font-weight-bold">
                        @if (isset($order))
                            #{{ $order->code }}
                        @endif
                    </div>
                    <div class="col col-12 mt-2 d-flex align-items-center">
                        <div class="col-6">
                            <div class="col-12 font-weight-bold">Restaurant:</div>
                            <div class="col-9">
                                @if (isset($order))
                                    <input class="form-control" value="{{ $order->restaurant->name }}" disabled>
                                    <input name="restaurant_id" value="{{ $order->restaurant->name }}" type="hidden">
                                @else
                                    <select name="restaurant_id" class="form-control">
                                        @foreach ($restaurants as $restaurant)
                                            <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-12 font-weight-bold">Table:</div>
                            <div class="col-9">
                                <select name="table_id" id="" class="form-control">
                                    @if (isset($order))
                                        @for ($i = 0; $i < $order->restaurant->quantity_table; $i++)
                                            <option value="{{ $i + 1 }}">Table: {{ $i + 1 }}</option>
                                        @endfor
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 mt-3 d-flex align-items-center">
                        <div class="col-6">
                            <div class="col-12 font-weight-bold">Payment:</div>
                            <div class="col-9">
                                <select name="payment" id="" class="form-control">
                                    @foreach ($payments as $payment)
                                        <option value="{{ $payment['value'] }}"
                                            @if (isset($order) && $order->payment == $payment['value']) selected @endif>{{ $payment['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-12 font-weight-bold">Status:</div>
                            <div class="col-9">
                                <select name="status" id="" class="form-control">
                                    @foreach ($status as $status)
                                        <option value="{{ $status['value'] }}"
                                            @if (isset($order) && $order->status == $status['value']) selected @endif>{{ $status['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 mt-3 d-flex">
                        <div class="col-6">
                            <div class="col-12 font-weight-bold">Item:</div>
                            <div class="col-12 d-flex">
                                <div class="col-9 p-0">
                                    @foreach ($order->order_food as $order_food)
                                        <div class="col-12 d-flex p-0 align-items-center mt-2">
                                            <div class="col-10 p-0">
                                                <select name="" class="form-control">
                                                    @php
                                                        $checked_values = [];
                                                    @endphp
                                                    @foreach ($order->restaurant->restaurantMeal as $restaurant_meal)
                                                        @foreach ($restaurant_meal->restaurantFood as $restaurant_food)
                                                            @if (!in_array($restaurant_food->food_id, $checked_values))
                                                                <option value="{{ $restaurant_food->food_id }}"
                                                                    @if ($order_food->food_id == $restaurant_food->food_id) selected @endif>
                                                                    {{ $restaurant_food->food_setting->name }}</option>
                                                                @php
                                                                    $checked_values[] = $restaurant_food->food_id;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2 p-0">
                                                <input type="text" class="form-control"
                                                    value="{{ $order_food->quantity }}">
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="col-2 mt-2">
                                    <button type="button" class="btn btn-primary btn-icon">
                                        <div><i class="fa fa-plus"></i></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-12 font-weight-bold">Total price:</div>
                            <div class="col-9">

                            </div>
                        </div>
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
