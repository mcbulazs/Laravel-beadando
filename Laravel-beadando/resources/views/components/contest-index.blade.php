<x-general-layout title="Contest">
    <div class="h-5/6 bg-cover bg-no-repeat" style="background-image: url({{$place->image}});">
        <h1 class="text-2xl text-center bg-gray-800 bg-opacity-50 text-white">{{$place->name}}</h1>
        <div class="h-96 grid grid-cols-2">
            <div class="bg-gray-800 bg-opacity-50 text-white p-5 border-r-4">
                <h2 class="text-2xl text-center">Hero</h2>
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
                        <tr>
                            <td>{{ $character->name }}</td>
                            <td>{{ $character->defence }}</td>
                            <td>{{ $character->strength }}</td>
                            <td>{{ $character->accuracy }}</td>
                            <td>{{ $character->magic }}</td>
                        </tr>
                    </tbody>
                </table>
                <p>Hero Hp: {{ $contest->characters->first()->pivot->hero_hp }}</p>
            </div>
            <div class="bg-gray-800 bg-opacity-50 text-white p-5 border-l-4">
                <h2 class="text-2xl text-center">Enemy</h2>
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
                        <tr>
                            <td>{{ $enemy->name }}</td>
                            <td>{{ $enemy->defence }}</td>
                            <td>{{ $enemy->strength }}</td>
                            <td>{{ $enemy->accuracy }}</td>
                            <td>{{ $enemy->magic }}</td>
                        </tr>
                    </tbody>
                </table>
                <p>Enemy Hp: {{ $contest->characters->first()->pivot->enemy_hp }}</p>
            </div>
        </div>
        <div class="grid grid-rows-2 w-full h-80">
            <p>History:<br>
                {{$contest->history}}
            </p>
            <div class="flex justify-center w-full h-10 gap-2">
                <a href="{{route()}}" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">Melee</a>
                <a href="{{route()}}" class="bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-600">Ranged</a>
                <a href="{{route()}}" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">Magic</a>
            </div>
        </div>
    </div>
</x-general-layout>
