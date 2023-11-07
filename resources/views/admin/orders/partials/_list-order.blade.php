@php
    use App\Classes\Enum\StatusOrderEnum;
    use App\Classes\Enum\PaymentOrderEnum;
@endphp
@foreach ($orders as $order)
    <tr class="@if ($order->status == StatusOrderEnum::PAID->value) pain-food @else pending-food @endif">
        <td class="font-weight-bold">#{{ $order->code }}</td>
        <td>
            @if (isset($order->user))
                {{ $order->user->first_name }} {{ $order->user->last_name }}
            @endif
        </td>
        <td>Table: {{ $order->table_id }}</td>
        <td>{{ $order->restaurant->name }}</td>
        <td>{{ $order->time_order }}</td>
        <td>{{ PaymentOrderEnum::getLabel($order->payment) }}</td>
        <td>{{ StatusOrderEnum::getLabel($order->status) }}</td>
        <td>
            @foreach ($order->order_food as $order_food)
                <li>x{{ $order_food->quantity }}
                    {{ $order_food->food_setting->name }}</li>
            @endforeach
        </td>
        <td>
            @php
                $total_price = $order->order_food->reduce(function ($carry, $item) {
                    return $carry + $item->price * $item->quantity;
                }, 0);
            @endphp
            {{ number_format($total_price) }}$
        </td>
        <td>
            <a class="table-action edit_order  mg-r-10" data-id={{ $order->id }}><i class="fa fa-pencil"></i></a>
            <a data-id="{{ $order->id }}" class="table-action" id="delete-order" data-toggle="modal"
                data-target="#deleteModal"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
@endforeach
