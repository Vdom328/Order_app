@php
    use App\Classes\Enum\CouponTypeEnum;
@endphp
@foreach ($coupons as $coupon)
<tr>
    <td>{{ $coupon->code }}</td>
    <td>
        @if ($coupon->status == 0)
        Enabled
        @else
        Disabled
        @endif
    </td>
    <td>{{ $coupon->memo }}</td>
    <td>
        {{ CouponTypeEnum::getLabel($coupon->type)}}
    </td>
    <td>
        @if ($coupon->type == CouponTypeEnum::PERCENT->value)
            {{ $coupon->percent }}%
        @else
            {{ $coupon->price }}$
        @endif
    </td>
    <td>
        <a class="table-action edit_coupon  mg-r-10" data-id={{ $coupon->id }}><i class="fa fa-pencil"></i></a>
        <a data-id="{{ $coupon->id }}" class="table-action" id="delete-coupon" data-toggle="modal"
            data-target="#deleteModal"><i class="fa fa-trash"></i></a>
    </td>
</tr>
@endforeach
