<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = auth()->user()->notes()
            ->latest('updated_at')
            ->paginate(3);

        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notebooks = Notebook::where('user_id', auth()->user()->id)->get();

        return view('notes.create', compact('notebooks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:120',
            'text' => 'required|min:3',
        ]);

        $note = auth()->user()->notes()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'text' => $request->text,
            'notebook_id' => $request->notebook_id,
        ]);

        return to_route('notes.show', $note)
            ->with('success', 'Note created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if($note->user->isNot(auth()->user())) {
            abort(403);
        }

        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if($note->user->isNot(auth()->user())) {
            abort(403);
        }

        $notebooks = Notebook::where('user_id', auth()->user()->id)->get();

        return view('notes.edit', compact('note', 'notebooks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if($note->user->isNot(auth()->user())) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|min:3|max:120',
            'text' => 'required|min:3',
        ]);

        auth()->user()->notes()->where(['id' => $note->id])->update([
            'title' => $request->title,
            'text' => $request->text,
            'notebook_id' => $request->notebook_id,
        ]);

        return to_route('notes.show', $note)
            ->with('success', 'Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if($note->user->isNot(auth()->user())) {
            abort(403);
        }

        $note->delete();

        return to_route('notes.index')
            ->with('success', 'Note has been deleted');
    }
}
