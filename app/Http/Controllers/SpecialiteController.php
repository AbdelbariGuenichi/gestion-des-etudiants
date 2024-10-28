<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class SpecialiteController extends Controller
{
    public function index()
    {
        $specialites = DB::table('specialites')->get();
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
            DB::table('specialites')->insert([
                'CodeSp' => $request->CodeSp,
                'DesignationSp' => $request->DesignationSp,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('specialites.index')->with('success', 'Spécialité ajoutée avec succès.');
        } catch (Exception $e) {
            return redirect()->route('specialites.index')->with('error', 'Erreur lors de l\'ajout de la spécialité.');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'CodeSp' => 'required|string|unique:specialites,CodeSp,' . $id . ',CodeSp',
            'DesignationSp' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('specialites.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::table('specialites')->where('CodeSp', $id)->update([
                'DesignationSp' => $request->DesignationSp,
                'updated_at' => now(),
            ]);

            return redirect()->route('specialites.index')->with('success', 'Spécialité modifiée avec succès.');
        } catch (Exception $e) {
            return redirect()->route('specialites.index')->with('error', 'Erreur lors de la modification de la spécialité.');
        }
    }

    public function destroy($id)
    {
        try {
            $relatedMatieres = DB::table('matieres')->where('CodeSp', $id)->exists();

            if ($relatedMatieres) {
                return redirect()->route('specialites.index')->with('error', 'Impossible de supprimer cette spécialité car elle est liée à des matières.');
            }

            $deleted = DB::table('specialites')->where('CodeSp', $id)->delete();

            if ($deleted) {
                return redirect()->route('specialites.index')->with('success', 'Spécialité supprimée avec succès.');
            } else {
                return redirect()->route('specialites.index')->with('error', 'La spécialité spécifiée est introuvable.');
            }
        } catch (Exception $e) {
            return redirect()->route('specialites.index')->with('error', 'Erreur lors de la suppression de la spécialité.');
        }
    }
}
