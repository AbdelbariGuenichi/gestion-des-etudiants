<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matiere;
use Illuminate\Support\Facades\Log;
use Exception;

class MatiereController extends Controller
{
    public function index()
    {
        try {
            $matieres = Matiere::all(); // Fetch all records using the model
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

            Matiere::create($validatedData); // Insert data using the model
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

            $matiere = Matiere::find($CodeMat); // Find by primary key
            if (!$matiere) {
                return redirect()->route('matieres.index')->with('error', 'Matière introuvable.');
            }

            $matiere->update($validatedData); // Update the record
            return redirect()->route('matieres.index')->with('success', 'Matière mise à jour avec succès');
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

            $matiere = Matiere::find($CodeMat); // Find by primary key
            if (!$matiere) {
                return redirect()->route('matieres.index')->with('error', 'Matière introuvable.');
            }

            $matiere->delete(); // Delete the record
            return redirect()->route('matieres.index')->with('success', 'Matière supprimée avec succès');
        } catch (Exception $e) {
            Log::error('Error deleting matiere: ' . $e->getMessage());
            return redirect()->route('matieres.index')->with('error', 'Une erreur est survenue lors de la suppression de la matière.');
        }
    }
}
