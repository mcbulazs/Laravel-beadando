<x-general-layout title="Characters">
    <div>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Defence</th>
                    <th>Strength</th>
                    <th>Accuracy</th>
                    <th>Magic</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($characters as $character)
                <tr>
                    <td><a href="{{ url('characters/'.$character->id) }}">{{ $character->name }}</a></td>
                    <td>{{ $character->defence }}</td>
                    <td>{{ $character->strength }}</td>
                    <td>{{ $character->accuracy }}</td>
                    <td>{{ $character->magic }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('characters.create') }}" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">Create</a>
    </div>
</x-general-layout>
