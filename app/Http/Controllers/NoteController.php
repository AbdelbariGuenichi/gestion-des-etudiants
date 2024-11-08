<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function index()
    {
        $notes = DB::table('notes')->get();
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

        DB::table('notes')->insert([
            'nci' => $request->nci, // Updated to match the correct column name
            'CodeMat' => $request->CodeMat,
            'DateResultat' => $request->DateResultat,
            'NoteControle' => $request->NoteControle,
            'NoteExamen' => $request->NoteExamen,
            'resultat' => $request->resultat,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

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

        // Update the note
        DB::table('notes')
            ->where('Nce', $nci) // Updated to match the correct column name
            ->update([
                'CodeMat' => $request->CodeMat,
                'DateResultat' => $request->DateResultat,
                'NoteControle' => $request->NoteControle,
                'NoteExamen' => $request->NoteExamen,
                'resultat' => $request->resultat,
                'updated_at' => now(),
            ]);

        return redirect()->route('notes.index')->with('success', 'Note modifiée avec succès.');
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nci' => 'required|string|exists:notes,Nce', // Make sure this matches the column name
        ], [
            'required' => 'Le champ :attribute est obligatoire.',
            'exists' => ':attribute n\'existe pas dans la base de données.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('notes.index')
                ->withErrors($validator)
                ->withInput();
        }

        // Delete the note
        DB::table('notes')->where('Nce', $request->nci)->delete(); // Updated to match the correct column name

        return redirect()->route('notes.index')->with('success', 'Note supprimée avec succès.');
    }
}
