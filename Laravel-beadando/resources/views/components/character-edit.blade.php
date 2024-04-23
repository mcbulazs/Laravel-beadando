@vite(['resources/css/app.css','resources/js/app.js'])
<x-general-layout :title="$character->name">
    <form action="{{ route('characters.update', $character) }}" method="POST" class="flex flex-col m-10">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name: </label>
            <input class="border-2" type="text" id="name" name="name" value="{{ $character->name }}">
        </div>
        @error('name')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div>
            <label for="defence">Defence: </label>
            <input class="border-2" type="number" id="defence" name="defence" value="{{ $character->defence }}">
        </div>
        @error('defence')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div>
            <label for="strength">Strength: </label>
            <input class="border-2" type="number" id="strength" name="strength" value="{{ $character->strength }}">
        </div>
        @error('strength')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div>
            <label for="accuracy">Accuracy: </label>
            <input class="border-2" type="number" id="accuracy" name="accuracy" value="{{ $character->accuracy }}">
        </div>
        @error('accuracy')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div>
            <label for="magic">Magic: </label>
            <input class="border-2" type="number" id="magic" name="magic" value="{{ $character->magic }}">
        </div>
        @error('magic')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div>
            <a href="{{ route('characters.show', $character) }}" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">Cancel</a>
            <button type="submit" class="bg-green-500 px-4 py-2 rounded hover:bg-green-600">Save</button>
        </div>
    </form>
</x-general-layout>
