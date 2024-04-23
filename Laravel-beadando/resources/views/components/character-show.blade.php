<x-general-layout :title="$character->name">
    @vite(['resources/css/app.css','resources/js/app.js'])

    <h1>{{ $character->name }}</h1>
    <h2>Stats</h2>
    <p>Defence: {{ $character->defence }}</p>
    <p>Strength: {{ $character->strength }}</p>
    <p>Accuracy: {{ $character->accuracy }}</p>
    <p>Magic: {{ $character->magic }}</p>
    <h2 class="mt-4">Contests: </h2>
    <table>
        <thead>
            <tr>
                <th>Place</th>
                <th>Opponent</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($character->contests as $contest)
            <tr class="border-t-4">
                <td class="border-r-4"><a href="{{ url('contests/'.$contest->id) }}">{{ $contest->place->name }}</a></td>
                <td>{{$contest->characters->where('id','!=',$character->id)->first()->name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="flex gap-3">
        <a href="{{ route('characters.edit', $character) }}" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">Edit</a>
        <form action="{{ route('characters.destroy', $character) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">Delete</button>
        </form>
    </div>
</x-general-layout>
