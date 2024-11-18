<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VilleController extends Controller
{
    public function index()
    {
        $villes = Ville::all();
        return view('ville', compact('villes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cpVilles' => 'required|string',
            'DesignationVilles' => 'required|string',
        ], [
            'required' => 'Le champ :attribute est obligatoire.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('villes.index')
                ->withErrors($validator)
                ->withInput();
        }

        Ville::create([
            'cpVilles' => $request->cpVilles,
            'DesignationVilles' => $request->DesignationVilles,
        ]);

        return redirect()->route('villes.index')->with('success', 'Ville ajoutée avec succès.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'cpVilles' => 'required|string',
            'DesignationVilles' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('villes.index')
                ->withErrors($validator)
                ->withInput();
        }

        $ville = Ville::findOrFail($id);
        $ville->update([
            'cpVilles' => $request->cpVilles,
            'DesignationVilles' => $request->DesignationVilles,
        ]);

        return redirect()->route('villes.index')->with('success', 'Ville modifiée avec succès.');
    }

    public function destroy($id)
    {
        $ville = Ville::findOrFail($id);
        $ville->delete();

        return redirect()->route('villes.index')->with('success', 'Ville supprimée avec succès.');
    }
}
