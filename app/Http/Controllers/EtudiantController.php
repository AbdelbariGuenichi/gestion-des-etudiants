<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EtudiantController extends Controller
{
    public function index()
    {
        try {
            $etudiants = Etudiant::all();
            return view('etudiant', compact('etudiants'));
        } catch (\Exception $e) {
            return redirect()->route('etudiants.index')->with('error', 'Erreur de chargement des étudiants.');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nce' => 'required|string|unique:etudiants,Nce',
            'nci' => 'required|string',
            'Nom' => 'required|string',
            'Prenom' => 'required|string',
            'DateNaissance' => 'required|date',
            'CpLieuNaissance' => 'required|string',
            'Adresse' => 'required|string',
            'CpAdresse' => 'required|string',
        ], [
            'required' => 'Le champ :attribute est obligatoire.',
            'unique' => ':attribute existe déjà.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'date' => 'Le champ :attribute doit être une date valide.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('etudiants.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Etudiant::create($request->all());
            return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('etudiants.index')->with('error', 'Erreur lors de l\'ajout de l\'étudiant.');
        }
    }

    public function update(Request $request, $nci)
    {
        $validator = Validator::make($request->all(), [
            'Nce' => 'required|string',
            'Nom' => 'required|string',
            'Prenom' => 'required|string',
            'DateNaissance' => 'required|date',
            'CpLieuNaissance' => 'required|string',
            'Adresse' => 'required|string',
            'CpAdresse' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('etudiants.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $etudiant = Etudiant::where('nci', $nci)->firstOrFail();
            $etudiant->update($request->all());

            return redirect()->route('etudiants.index')->with('success', 'Étudiant modifié avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('etudiants.index')->with('error', 'Erreur lors de la modification de l\'étudiant.');
        }
    }

    public function destroy($Nce)
    {
        try {
            $etudiant = Etudiant::where('Nce', $Nce)->firstOrFail();
            $etudiant->delete();

            return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('etudiants.index')->with('error', 'Erreur lors de la suppression de l\'étudiant.');
        }
    }
}
