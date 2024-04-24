@vite(['resources/css/app.css','resources/js/app.js'])
<x-general-layout title="places">
    <div>
        <a href="{{route('places.create')}}" class="bg-green-500 px-4 py-2 rounded hover:bg-green-600">Create a new place</a>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($places as $place)
                <tr>
                    <td>{{$place->name}}</td>
                    <td><img src="{{asset($place->image)}}" alt="{{$place->name}}" width="100"></td>
                    <td>
                        <a href="{{route('places.edit',$place->id)}}" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">Edit</a>
                        <form action="{{route('places.destroy',$place->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-general-layout>
