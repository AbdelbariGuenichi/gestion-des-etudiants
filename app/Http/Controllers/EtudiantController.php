<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class EtudiantController extends Controller
{
    public function index()
    {
        try {
            $etudiants = DB::table('etudiants')->get();
            return view('etudiant', compact('etudiants'));
        } catch (QueryException $e) {
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
            DB::table('etudiants')->insert([
                'Nce' => $request->Nce,
                'nci' => $request->nci,
                'Nom' => $request->Nom,
                'Prenom' => $request->Prenom,
                'DateNaissance' => $request->DateNaissance,
                'CpLieuNaissance' => $request->CpLieuNaissance,
                'Adresse' => $request->Adresse,
                'CpAdresse' => $request->CpAdresse,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès.');
        } catch (QueryException $e) {
            return redirect()->route('etudiants.index')->with('error', 'Erreur lors de l\'ajout de l\'étudiant.');
        }
    }

    public function update(Request $request, $Nce)
    {
        $validator = Validator::make($request->all(), [
            'nci' => 'required|string',
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
            $affected = DB::table('etudiants')->where('Nce', $Nce)->update([
                'nci' => $request->nci,
                'Nom' => $request->Nom,
                'Prenom' => $request->Prenom,
                'DateNaissance' => $request->DateNaissance,
                'CpLieuNaissance' => $request->CpLieuNaissance,
                'Adresse' => $request->Adresse,
                'CpAdresse' => $request->CpAdresse,
                'updated_at' => now(),
            ]);

            if ($affected) {
                return redirect()->route('etudiants.index')->with('success', 'Étudiant modifié avec succès.');
            } else {
                return redirect()->route('etudiants.index')->with('error', 'Étudiant non trouvé.');
            }
        } catch (QueryException $e) {
            return redirect()->route('etudiants.index')->with('error', 'Erreur lors de la modification de l\'étudiant.');
        }
    }

    public function destroy($Nce)
    {
        try {
            $deleted = DB::table('etudiants')->where('Nce', $Nce)->delete();

            if ($deleted) {
                return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès.');
            } else {
                return redirect()->route('etudiants.index')->with('error', 'Étudiant non trouvé.');
            }
        } catch (QueryException $e) {
            return redirect()->route('etudiants.index')->with('error', 'Erreur lors de la suppression de l\'étudiant.');
        }
    }
}
