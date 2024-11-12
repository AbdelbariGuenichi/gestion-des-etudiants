<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class MatiereController extends Controller
{
    public function index()
    {
        try {
            $matieres = DB::table('matieres')->get();
            return view('matiere', ['matieres' => $matieres]);
        } catch (Exception $e) {
            Log::error('Error fetching matieres: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la récupération des matières.');
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'CodeMat' => 'required|string|max:255',
                'CodeSp' => 'required|string|max:255',
                'niveau' => 'required|string|max:255',
                'coef' => 'required|numeric',
                'credit' => 'required|numeric',
            ]);

            DB::table('matieres')->insert(array_merge($validatedData, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));

            return redirect()->route('matieres.index')->with('success', 'Matière ajoutée avec succès');
        } catch (Exception $e) {
            Log::error('Error adding matiere: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Une erreur est survenue lors de l\'ajout de la matière.');
        }
    }

    public function update(Request $request, $CodeMat)
    {
        try {
            $validatedData = $request->validate([
                'CodeMat' => 'required|string|max:255',
                'CodeSp' => 'required|string|max:255',
                'niveau' => 'required|string|max:255',
                'coef' => 'required|numeric',
                'credit' => 'required|numeric',
            ]);

            $updated = DB::table('matieres')->where('CodeMat', $CodeMat)->update($validatedData);

            if ($updated) {
                return redirect()->route('matieres.index')->with('success', 'Matière mise à jour avec succès');
            } else {
                return redirect()->route('matieres.index')->with('error', 'Matière introuvable ou aucune modification apportée.');
            }
        } catch (Exception $e) {
            Log::error('Error updating matiere: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Une erreur est survenue lors de la mise à jour de la matière.');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $CodeMat = $request->input('CodeMat');

            if (empty($CodeMat)) {
                return redirect()->route('matieres.index')->with('error', 'L\'identifiant de la matière n\'a pas été fourni.');
            }

            $deleted = DB::table('matieres')->where('CodeMat', $CodeMat)->delete();

            if ($deleted) {
                return redirect()->route('matieres.index')->with('success', 'Matière supprimée avec succès');
            } else {
                return redirect()->route('matieres.index')->with('error', 'Matière introuvable.');
            }
        } catch (Exception $e) {
            Log::error('Error deleting matiere: ' . $e->getMessage());
            return redirect()->route('matieres.index')->with('error', 'Une erreur est survenue lors de la suppression de la matière.');
        }
    }
}
