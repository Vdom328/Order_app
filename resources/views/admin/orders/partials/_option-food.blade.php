<div class="col-12 d-flex p-0 align-items-center mt-2 food_order"  >
    <div class="col-10 p-0">
        <select name="order_food[{{ $foodCount }}][food_id]" class="form-control">
            @php
                $checked_values = [];
            @endphp
            @foreach ($restaurant->restaurantMeal as $restaurant_meal)
                @foreach ($restaurant_meal->restaurantFood as $restaurant_food)
                    @if (!in_array($restaurant_food->food_id, $checked_values))
                        <option value="{{ $restaurant_food->food_id }}">{{ $restaurant_food->food_setting->name }}</option>
                        @php
                            $checked_values[] = $restaurant_food->food_id;
                        @endphp
                    @endif
                @endforeach
            @endforeach
        </select>
    </div>
    <div class="col-2 p-0">
        <input type="text" class="form-control" name="order_food[{{ $foodCount }}][quantity]" value="">
    </div>
</div>
