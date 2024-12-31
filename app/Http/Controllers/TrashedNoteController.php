<?php

namespace App\Http\Controllers;

use App\Models\Note;

class TrashedNoteController extends Controller
{
    public function index()
    {
        $notes = auth()->user()->notes()
            ->onlyTrashed()
            ->latest('updated_at')
            ->paginate(3);

        return view('notes.index', compact('notes'));
    }

    public function show(Note $note)
    {
        if ($note->user->isNot(auth()->user())) {
            abort(403);
        }

        return view('notes.show', compact('note'));
    }

    public function update(Note $note)
    {
        if ($note->user->isNot(auth()->user())) {
            abort(403);
        }

        $note->restore();

        return to_route('notes.show', $note)
            ->with('success', 'Note restored.');
    }
}
