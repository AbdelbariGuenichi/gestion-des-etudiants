<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatiereController extends Controller
{
    public function index()
    {
        $matieres = DB::table('matieres')->get();
        return view('matiere', ['matieres' => $matieres]);
    }

    public function store(Request $request)
    {
        DB::table('matieres')->insert([
            'CodeMat' => $request->CodeMat,
            'CodeSp' => $request->CodeSp,
            'niveau' => $request->niveau,
            'coef' => $request->coef,
            'credit' => $request->credit,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('matieres.index')->with('success', 'Matière ajoutée avec succès');
    }

    public function update(Request $request, $CodeMat)
    {
        $validatedData = $request->validate([
            'CodeMat' => 'required|string|max:255',
            'CodeSp' => 'required|string|max:255',
            'niveau' => 'required|string|max:255',
            'coef' => 'required|numeric',
            'credit' => 'required|numeric',
        ]);

        DB::table('matieres')->where('CodeMat', $CodeMat)->update($validatedData);

        return redirect()->route('matieres.index')->with('success', 'Matière mise à jour avec succès');
    }

    public function destroy(Request $request)
    {
        $CodeMat = $request->input('CodeMat');

        if (empty($CodeMat)) {
            return redirect()->route('matieres.index')->with('error', 'Matière identifier not provided.');
        }

        $deleted = DB::table('matieres')->where('CodeMat', $CodeMat)->delete();

        if ($deleted) {
            return redirect()->route('matieres.index')->with('success', 'Matière supprimée avec succès');
        } else {
            return redirect()->route('matieres.index')->with('error', 'Matière not found.');
        }
    }
}
