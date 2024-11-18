<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InscriptionController extends Controller
{
    public function index()
    {
        $inscriptions = Inscription::all();
        return view('inscription', compact('inscriptions'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nci' => 'required|string|max:255',
            'CodeSp' => 'required|string|max:255',
            'DateInscription' => 'required|date',
            'niveau' => 'required|string|max:255',
            'resultatFinale' => 'required|string|max:255',
            'Mention' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('inscriptions.index')->withErrors($validator)->withInput();
        }

        Inscription::create([
            'nci' => $request->nci,
            'CodeSp' => $request->CodeSp,
            'DateInscription' => $request->DateInscription,
            'niveau' => $request->niveau,
            'resultatFinale' => $request->resultatFinale,
            'Mention' => $request->Mention,
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
            return redirect()->route('inscriptions.index')->withErrors($validator)->withInput();
        }

        $inscription = Inscription::where('nci', $nci)
            ->where('CodeSp', $request->CodeSp)
            ->where('DateInscription', $request->DateInscription)
            ->first();

        if ($inscription) {
            $inscription->update([
                'niveau' => $request->niveau,
                'resultatFinale' => $request->resultatFinale,
                'Mention' => $request->Mention,
            ]);
            return redirect()->route('inscriptions.index')->with('success', 'Inscription modifiée avec succès.');
        }

        return redirect()->route('inscriptions.index')->with('error', 'Aucune inscription trouvée pour cette mise à jour.');
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nci' => 'required|string|max:255',
            'CodeSp' => 'required|string|max:255',
            'DateInscription' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('inscriptions.index')->withErrors($validator);
        }

        $inscription = Inscription::where('nci', $request->nci)
            ->where('CodeSp', $request->CodeSp)
            ->where('DateInscription', $request->DateInscription)
            ->first();

        if ($inscription) {
            $inscription->delete();
            return redirect()->route('inscriptions.index')->with('success', 'Inscription supprimée avec succès.');
        }

        return redirect()->route('inscriptions.index')->with('error', 'Inscription non trouvée ou déjà supprimée.');
    }
}
