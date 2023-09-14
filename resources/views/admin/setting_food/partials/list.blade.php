@foreach ($foods as $food)
    <tr>
        <td class="images_food">
            <div id="carousel-{{ $food->id }}" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($food->foodImages as $index => $image)
                        <div class="carousel-item{{ $index == 0 ? ' active' : '' }}">
                            <img src="{{ asset('storage/food_images/' . $image->image) }}" alt="" width="100%">
                        </div>
                    @endforeach
                </div>

                <!-- Nút "prev" -->
                <a class="carousel-control-prev" href="#carousel-{{ $food->id }}" role="button"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>

                <!-- Nút "next" -->
                <a class="carousel-control-next" href="#carousel-{{ $food->id }}" role="button"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </td>
        <td class="pl-4">{{ $food->name }}</td>
        <td class="pl-4">{{ $food->quantity }}</td>
        <td class="pl-4">{{ number_format($food->price) }}</td>
        <td class="pl-4">
            {{ $food->status == config('const.food.status.Active') ? 'Active' : 'Inactive' }}
        </td>
        <td class="text-center">
            <a href="" class="table-action mg-r-10" href="#"><i class="fa fa-pencil"></i></a>
            <a data-id="" class="table-action" id="deleteUser" data-toggle="modal" data-target="#deleteModal"><i
                    class="fa fa-trash"></i></a>
        </td>
    </tr>
@endforeach
