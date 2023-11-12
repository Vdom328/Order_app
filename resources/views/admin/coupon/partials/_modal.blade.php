@php
    use App\Classes\Enum\CouponTypeEnum;
@endphp
<div class="modal fade" id="edit-coupon" tabindex="-1" role="dialog" aria-labelledby="ModalRole" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Coupon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 mg-b-30 mt-3 bg-white " id="form-coupon">
                    <div class="col-12 d-flex flex-wrap">
                        <input type="hidden" name="id-edit" value="{{ $coupon->id }}">
                        <div class="col-3">
                            <label for="">Code</label>
                            <input type="text" name="code-edit" value="{{ $coupon->code }}" class="form-control" placeholder="Code">
                        </div>
                        <div class="col-3">
                            <label for="">Percent</label>
                            <div class="d-flex">
                                <input type="radio" @if ($coupon->type == CouponTypeEnum::PERCENT->value) checked @endif name="type-edit" value="{{ CouponTypeEnum::PERCENT->value }}">
                                <input type="number" @if ($coupon->type == CouponTypeEnum::PRICE->value) disabled @endif value="{{ $coupon->percent }}" name="percent-edit" class="form-control ml-4" placeholder="Percent">
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="">Price</label>
                            <div class="d-flex">
                                <input type="radio" name="type-edit" @if ($coupon->type == CouponTypeEnum::PRICE->value) checked @endif value="{{ CouponTypeEnum::PRICE->value }}">
                                <input type="number" @if ($coupon->type == CouponTypeEnum::PERCENT->value) disabled @endif value="{{ $coupon->price }}" name="price-edit" class="form-control ml-4" placeholder="Price">
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="">Enabled/Disabled</label>
                            <div class="custom-control custom-switch d-flex align-items-center ml-2">
                                <input type="checkbox"
                                @if ($coupon->status == 1 )
                                    checked
                                @endif   class="custom-control-input form-control" name="status_coupon-edit"
                                    id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-wrap mt-3">
                        <div class="col-12">
                            <label for="">Memo:</label>
                            <textarea name="memo-edit" id="" cols="30" rows="3" class="form-control">{{ $coupon->memo }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect"  id="submit-form-edit-coupon">Save changes</button>
            </div>
        </div>
    </div>
</div>
