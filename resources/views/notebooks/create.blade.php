<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            New Notebook
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg max-w-2xl">
                <form action="{{ route('notebooks.store') }}" method="POST">
                    @csrf

                    <x-text-input name="name" class="w-full" placeholder="Notebook name..." value="{{ @old('name') }}"></x-text-input>
                    @error('name')
                        <span class="text-sm mt-2 text-red-500">{{ $message }}</span>
                    @enderror
                    <br>
                    <x-primary-button class="mt-6">Save Notebook</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
