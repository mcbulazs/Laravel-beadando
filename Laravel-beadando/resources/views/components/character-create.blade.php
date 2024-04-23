@vite(['resources/css/app.css','resources/js/app.js'])
<x-general-layout title="Create yout Character">
    <form action="{{ route('characters.store') }}" method="POST" class="flex flex-col m-10">
        @csrf
        <div>
            <label for="name">Name: </label>
            <input class="border-2" type="text" id="name" name="name">
        </div>
        @error('name')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div>
            <label for="defence">Defence: </label>
            <input class="border-2" type="text" id="defence" name="defence">
        </div>
        @error('defence')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div>
            <label for="strength">Strength: </label>
            <input class="border-2" type="text" id="strength" name="strength">
        </div>
        @error('strength')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div>
            <label for="accuracy">Accuracy: </label>
            <input class="border-2" type="text" id="accuracy" name="accuracy">
        </div>
        @error('accuracy')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div>
            <label for="magic">Magic: </label>
            <input class="border-2" type="text" id="magic" name="magic">
        </div>
        @error('magic')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
        @if ($isAdmin)
        <label for="enemy">Enemy: </label>
        <select name="enemy" id="enemy">
            <option value="true">True</option>
            <option selected value="false">False</option>
        </select>
        @endif
        <div>
            <a href="{{ url('characters.index')}}" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">Cancel</a>
            <button type="submit" class="bg-green-500 px-4 py-2 rounded hover:bg-green-600">Save</button>
        </div>
    </form>
</x-general-layout>
