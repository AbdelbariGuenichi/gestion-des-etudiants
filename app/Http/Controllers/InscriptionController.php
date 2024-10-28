<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InscriptionController extends Controller
{
    public function index()
    {
        $inscriptions = DB::table('inscriptions')->get();
        return view('inscription', compact('inscriptions'));
    }

    public function store(Request $request)
    {
        $exists = DB::table('etudiants')->where('nci', $request->nci)->exists();
        if (!$exists) {
            return redirect()->route('inscriptions.index')->withErrors(['nci' => "L'étudiant avec le NCI {$request->nci} n'existe pas."])->withInput();
        }

        $validator = Validator::make($request->all(), [
            'nci' => 'required|string|max:255',
            'CodeSp' => 'required|string|max:255',
            'DateInscription' => 'required|date',
            'niveau' => 'required|string|max:255',
            'resultatFinale' => 'required|string|max:255',
            'Mention' => 'required|string|max:255',
        ], [
            'required' => 'Le champ :attribute est obligatoire.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'date' => 'Le champ :attribute doit être une date valide.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('inscriptions.index')->withErrors($validator)->withInput();
        }

        DB::table('inscriptions')->insert([
            'nci' => $request->nci,
            'CodeSp' => $request->CodeSp,
            'DateInscription' => $request->DateInscription,
            'niveau' => $request->niveau,
            'resultatFinale' => $request->resultatFinale,
            'Mention' => $request->Mention,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('inscriptions.index')->with('success', 'Inscription ajoutée avec succès.');
    }
    public function update(Request $request, $nci)
    {
        $validator = Validator::make($request->all(), [
            'CodeSp' => 'required|string|max:255',
            'DateInscription' => 'required|date',
            'niveau' => 'required|string|max:255',
            'resultatFinale' => 'required|string|max:255',
            'Mention' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('inscriptions.index')
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('inscriptions')->where('nci', $nci)->update([
            'CodeSp' => $request->CodeSp,
            'DateInscription' => $request->DateInscription,
            'niveau' => $request->niveau,
            'resultatFinale' => $request->resultatFinale,
            'Mention' => $request->Mention,
            'updated_at' => now(),
        ]);

        return redirect()->route('inscriptions.index')->with('success', 'Inscription modifiée avec succès.');
    }

    public function destroy($nci)
    {
        // Ensure the inscription exists before attempting to delete
        $deleted = DB::table('inscriptions')->where('nci', $nci)->delete();

        if ($deleted) {
            return redirect()->route('inscriptions.index')->with('success', 'Inscription supprimée avec succès.');
        } else {
            return redirect()->route('inscriptions.index')->with('error', 'Inscription non trouvée.');
        }
    }
}
