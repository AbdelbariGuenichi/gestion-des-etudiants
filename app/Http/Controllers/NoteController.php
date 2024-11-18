<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all(); // Fetch all notes using the model
        return view('note', compact('notes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nci' => 'required|string|exists:etudiants,nci',
            'CodeMat' => 'required|string|exists:matieres,CodeMat',
            'DateResultat' => 'required|date',
            'NoteControle' => 'required|numeric',
            'NoteExamen' => 'required|numeric',
            'resultat' => 'required|string',
        ], [
            'required' => 'Le champ :attribute est obligatoire.',
            'exists' => ':attribute n\'existe pas dans la base de données.',
            'date' => 'Le champ :attribute doit être une date valide.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'numeric' => 'Le champ :attribute doit être un nombre.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('notes.index')
                ->withErrors($validator)
                ->withInput();
        }

        Note::create($request->all()); // Use model to insert data

        return redirect()->route('notes.index')->with('success', 'Note enregistrée avec succès.');
    }

    public function update(Request $request, $nci)
    {
        $validator = Validator::make($request->all(), [
            'CodeMat' => 'required|string|exists:matieres,CodeMat',
            'DateResultat' => 'required|date',
            'NoteControle' => 'required|numeric',
            'NoteExamen' => 'required|numeric',
            'resultat' => 'required|string',
        ], [
            'required' => 'Le champ :attribute est obligatoire.',
            'exists' => ':attribute n\'existe pas dans la base de données.',
            'date' => 'Le champ :attribute doit être une date valide.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'numeric' => 'Le champ :attribute doit être un nombre.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('notes.index')
                ->withErrors($validator)
                ->withInput();
        }

        $note = Note::find($nci); // Fetch note by primary key

        if (!$note) {
            return redirect()->route('notes.index')->with('error', 'Note introuvable.');
        }

        $note->update($request->all()); // Update note using model

        return redirect()->route('notes.index')->with('success', 'Note modifiée avec succès.');
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nci' => 'required|string',
        ], [
            'required' => 'Le champ :attribute est obligatoire.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('notes.index')
                ->withErrors($validator)
                ->withInput();
        }

        $note = Note::find($request->nci); // Fetch note by primary key

        if (!$note) {
            return redirect()->route('notes.index')->with('error', 'Note introuvable.');
        }

        $note->delete(); // Delete note using model

        return redirect()->route('notes.index')->with('success', 'Note supprimée avec succès.');
    }
}
