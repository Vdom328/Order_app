@foreach ($foods as $food)
    <div class="col-3 p-2 d-flex align-items-center">
        <input type="checkbox" name="food_id[]" class="form-check-input mb-1" id="food_{{ $food->id }}"
        @foreach ($restaurantMeals->restaurantFood as $restaurantFood)
                @if ($restaurantFood->food_id == $food->id)
                    checked
                @break
                @endif
            @endforeach
            value="{{ $food->id }}"><label for="food_{{ $food->id }}" class="pl-2">{{ $food->name }}</label>
    </div>
@endforeach
