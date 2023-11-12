<div class="modal fade" id="new-order" tabindex="-1" role="dialog" aria-labelledby="ModalRole" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Orders</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-new-order" method="post" action="{{ route('admin.order.createNewOrder') }}" class="col-12 col-md-12 p-0 m-0">
                    @csrf
                    <div class="col-12 d-flex justify-content-end font-weight-bold">
                    </div>
                    <div class="col col-12 mt-2 d-flex align-items-center">
                        <div class="col-6">
                            <div class="col-12 font-weight-bold">Restaurant:</div>
                            <div class="col-9">
                                <select name="restaurant_id" class="form-control restaurant">
                                    @foreach ($restaurants as $restaurant)
                                        <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-12 font-weight-bold">Table:</div>
                            <div class="col-9">
                                <select name="table_id" id="table-create-order" class="form-control">
                                    @for ($i = 0; $i < $restaurant->quantity_table; $i++)
                                        <option value="{{ $i + 1 }}">Table: {{ $i + 1 }}</option>
                                    @endfor
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
                                <div class="col-9 p-0" id="list-fodd-add-new">


                                </div>
                                <div class="col-2 mt-2">
                                    <button type="button" class="btn btn-primary btn-icon" id="add-food-new-order">
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
                <button type="button" class="btn btn-primary waves-effect"  id="submit-form-new-order">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
