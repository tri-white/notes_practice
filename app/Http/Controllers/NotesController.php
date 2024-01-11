<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use App\Http\Requests\StoreNotesRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\NotesResource;
use App\Http\Resources\NotesCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Notes::all();
        
        if (request()->ajax()) {
            return new NotesCollection($notes);
        }

        return view('notes.index',['notes'=>$notes]);
    }

    public function create(){
        return view('notes.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotesRequest $request)
    {
        $user = Auth::user();
        $note = $user->notes()->create($request->validated());

        if ($request->ajax()) {
            return new NotesResource($note);
        }

        return redirect(route('notes.show',['id'=>$note->id]));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $note = Notes::findOrFail($id);
        if (request()->ajax()) {
        return new NotesResource($note);
        }

        return view('notes.show', ['note'=>$note]);
    }

    public function edit($id){
        $note = Notes::findOrFail($id);

        return view('notes.edit',['note'=>$note]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(StoreNotesRequest $request, Notes $notes)
    {
        $note =  Notes::findOrfail($notes);
        $note->update(Arr::except($request->validated(), 'user_id'));
        if ($request->ajax()) {
            return $note;    // no need for parsing into JSON, eloquent is automatically returned in JSON format
        }
        return redirect(route('notes.show',['id'=>$note->id]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $note = Notes::findOrFail($id);
        $note->delete();
        if (request()->ajax()) {
            return response()->json(['message'=>'deleted'],200);
        }
        
        return redirect(route('notes.index'));
    }
}
