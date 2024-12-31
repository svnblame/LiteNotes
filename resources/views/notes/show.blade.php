<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Notes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-alert-success>{{ session('success') }}</x-alert-success>

            <div class="flex gap-6">
                <p class="opacity-50"><strong>Created:</strong> {{ $note->created_at->diffForHumans() }}</p>
                <p class="opacity-50"><strong>Updated: {{ $note->updated_at->diffForHumans() }}</strong></p>

                <x-link-button href="{{ route('notes.edit', $note) }}" class="ml-auto ">Edit Note</x-link-button>

                <form action="{{ route('notes.destroy', $note) }}" method="POST">
                    @method('DELETE')
                    @csrf

                    <x-primary-button
                        class="bg-red-400 hover:bg-red-600 focus:bg-red-600"
                        onclick="return confirm('Are you sure you want to delete this note?')">Delete</x-primary-button>
                </form>
            </div>
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-xl text-indigo-600">
                    {{ $note->title }}
                </h2>
                <p class="mt-4 whitespace-pre-wrap">{{ $note->text }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
