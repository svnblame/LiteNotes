<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            New Note
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg max-w-2xl">
                <form action="{{ route('notes.store') }}" method="POST">
                    @csrf
                    <x-text-input name="title" class="w-full" placeholder="Note title..." value="{{ @old('title') }}"></x-text-input>
                    @error('title')
                        <span class="text-sm mt-2 text-red-500">{{ $message }}</span>
                    @enderror
                    <x-text-area name="text" placeholder="Type your note..." rows="8" value="{{ @old('text') }}" class="w-full mt-6"></x-text-area>
                    @error('text')
                        <span class="text-sm mt-2 text-red-500">{{ $message }}</span>
                    @enderror
                    <br>
                    <x-primary-button class="mt-6">Save Note</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
