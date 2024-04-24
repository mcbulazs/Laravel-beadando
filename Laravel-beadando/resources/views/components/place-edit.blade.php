@vite(['resources/css/app.css','resources/js/app.js'])
<x-general-layout title="Create a new place">
    <form action="{{route('places.update',$place)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="{{$place->name}}" id="name">
        </div>
        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit" class="bg-green-500 px-4 py-2 rounded hover:bg-green-600">Edit</button>
    </form>
</x-general-layout>
