@for ($i = 0; $i < $restaurant->quantity_table; $i++)
    <option value="{{ $i + 1 }}">Table: {{ $i + 1 }}</option>
@endfor
