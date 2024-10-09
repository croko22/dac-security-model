<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    public function index()
    {
        $notes = auth()->user()->notes;
        $shared_notes = Note::whereHas('permissions', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();
        return view('notes.index', compact('notes', 'shared_notes'));
    }

    public function show(Note $note)
    {
        // $this->authorize('view', $note);
        Gate::authorize('view', $note);
        $users = User::all()->except(auth()->id());

        return view('notes.show', compact('note', 'users'));
    }

    public function store(Request $request)
    {
        $note = Note::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('notes.show', $note);
    }

    public function update(Request $request, Note $note)
    {
        // $this->authorize('update', $note);
        Gate::authorize('update', $note);

        $note->update($request->only('title', 'content'));
        return redirect()->route('notes.show', $note);
    }

    public function share(Note $note, Request $request)
    {
        // $this->authorize('update', $note); // Only owner or those with write access can share
        Gate::authorize('update', $note);

        $note->permissions()->create([
            'user_id' => $request->user_id,
            'permission' => $request->permission, // 'read' or 'write'
        ]);

        return redirect()->route('notes.show', $note);
    }

    public function revoke(Note $note, Request $request)
    {
        // $this->authorize('update', $note); // Only owner or those with write access can revoke
        Gate::authorize('update', $note);

        $note->permissions()->where('user_id', $request->user_id)->delete();
        return redirect()->route('notes.show', $note);
    }
}
