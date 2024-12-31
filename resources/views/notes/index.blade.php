<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Notes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-alert-success>{{ session('success') }}</x-alert-success>

            <x-link-button href="{{ route('notes.create') }}">Create Note</x-link-button>

            @forelse($notes as $note)
                <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                    @isset($note->notebook->name)
                        <x-notebook-name>{{ $note->notebook->name }}</x-notebook-name>
                    @endisset

                    <h2 class="font-bold text-xl text-indigo-600">
                        <a href="{{ route('notes.show', $note) }}" class="hover:underline hover:opacity-80">{{ $note->title }}</a>
                    </h2>

                    <p class="mt-2">{{ Str::limit($note->text, 120) }}</p>
                    <span class="block mt-4 text-sm opacity-40">{{ $note->updated_at->diffForHumans() }}</span>
                </div>
            @empty
                <p>You have no notes yet</p>
            @endforelse

            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
