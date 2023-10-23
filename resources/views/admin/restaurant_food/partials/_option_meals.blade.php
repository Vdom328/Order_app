<select class="selectpicker form-control" name="type_meal" id="type_meal">
    @foreach ($meals as $meal)
        <option value="{{ $meal->meal }}">{{ $meal->name }}</option>
    @endforeach
</select>
