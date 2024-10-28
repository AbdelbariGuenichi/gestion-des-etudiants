<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VilleController extends Controller
{
    public function index()
    {
        $villes = DB::table('villes')->get();
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

        DB::table('villes')->insert([
            'cpVilles' => $request->cpVilles,
            'DesignationVilles' => $request->DesignationVilles,
            'created_at' => now(),
            'updated_at' => now(),
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

        DB::table('villes')->where('id', $id)->update([
            'cpVilles' => $request->cpVilles,
            'DesignationVilles' => $request->DesignationVilles,
            'updated_at' => now(),
        ]);

        return redirect()->route('villes.index')->with('success', 'Ville modifiée avec succès.');
    }

    public function destroy($id)
    {
        DB::table('villes')->where('id', $id)->delete();
        return redirect()->route('villes.index')->with('success', 'Ville supprimée avec succès.');
    }
}
