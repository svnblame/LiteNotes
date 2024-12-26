<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $notes = Note::where('user_id', $user_id)
            ->latest('updated_at')
            ->paginate(5);

        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('notes.create');
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

        Note::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'text' => $request->text,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if($note->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
