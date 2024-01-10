<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use App\Http\Requests\StoreNotesRequest;
use App\Http\Requests\UpdateNotesRequest;
use Illuminate\Support\Facades\Auth;
class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Notes::all());
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
    public function store(StoreNotesRequest $request)
    {
        $user = Auth::user();
        
        return $user->notes()->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $note = Notes::find($id);
        return response()->json($note);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notes $notes)
    {
        return view('notes.edit',['note'=>$notes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotesRequest $request, Notes $notes)
    {
        $note =  Notes::findOrfail($notes);
        $note->update($request->all());
        return response()->json($note);   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $note = Notes::findOrFail($id);
        $note->delete();
        return response()->setStatusCode(200)->json($note);
    }
}
