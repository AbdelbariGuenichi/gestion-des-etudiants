<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\Specialite;

class SpecialiteController extends Controller
{
    public function index()
    {
        $specialites = Specialite::all();
        return view('specialite', compact('specialites'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'CodeSp' => 'required|string|unique:specialites,CodeSp',
            'DesignationSp' => 'required|string',
        ], [
            'required' => 'Le champ :attribute est obligatoire.',
            'unique' => ':attribute existe déjà.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('specialites.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Specialite::create([
                'CodeSp' => $request->CodeSp,
                'DesignationSp' => $request->DesignationSp,
            ]);

            return redirect()->route('specialites.index')->with('success', 'Spécialité ajoutée avec succès.');
        } catch (Exception $e) {
            return redirect()->route('specialites.index')->with('error', 'Erreur lors de l\'ajout de la spécialité.');
        }
    }

    public function update(Request $request, $CodeSp)
    {
        $validator = Validator::make($request->all(), [
            'CodeSp' => 'required|string|unique:specialites,CodeSp,' . $CodeSp . ',CodeSp',
            'DesignationSp' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('specialites.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $specialite = Specialite::findOrFail($CodeSp);
            $specialite->update([
                'DesignationSp' => $request->DesignationSp,
            ]);

            return redirect()->route('specialites.index')->with('success', 'Spécialité modifiée avec succès.');
        } catch (Exception $e) {
            return redirect()->route('specialites.index')->with('error', 'Erreur lors de la modification de la spécialité.');
        }
    }

    public function destroy($CodeSp)
{
    try {
        $specialite = Specialite::where('CodeSp', $CodeSp)->first();

        if (!$specialite) {
            return redirect()->route('specialites.index')->with('error', 'Spécialité introuvable.');
        }

        $specialite->delete();
        return redirect()->route('specialites.index')->with('success', 'Spécialité supprimée avec succès.');
    } catch (Exception $e) {
        return redirect()->route('specialites.index')->with('error', 'Erreur lors de la suppression.');
    }
}

}
