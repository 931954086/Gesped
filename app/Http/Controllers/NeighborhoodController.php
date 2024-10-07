<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Neighborhood;
use App\Models\Municipality;

class NeighborhoodController extends Controller
{
    public function index()
    {
        $neighborhoods = Neighborhood::all();
        return view('neighborhoods.index', compact('neighborhoods'));
    }

    public function create()
    {
        $municipalities = Municipality::all();
        return view('neighborhoods.create', compact('municipalities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'municipality_id' => 'required|integer',
        ]);

        Neighborhood::create($request->all());

        return redirect()->route('neighborhoods.index')->with('success', 'Bairro criado com sucesso.');
    }

    public function edit($id)
    {
        $neighborhood = Neighborhood::find($id);
        $municipalities = Municipality::all();
        
        if (!$neighborhood) {
            return redirect()->route('neighborhoods.index')->with('error', 'Bairro não encontrado.');
        }
        return view('neighborhoods.create', compact('neighborhood', 'municipalities'));
    }

    public function update(Request $request, $id)
    {
        $neighborhood = Neighborhood::find($id);
        $request->validate([
            'name' => 'required|max:255',
            'municipality_id' => 'required|integer',
        ]);

        if (!$neighborhood) {
            return redirect()->route('neighborhoods.index')->with('error', 'Bairro não encontrado.');
        }

        $neighborhood->update($request->all());

        return redirect()->route('neighborhoods.index')->with('success', 'Bairro atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $neighborhood = Neighborhood::find($id);
        
        if ($neighborhood) {
            $neighborhood->delete();
            return redirect()->route('neighborhoods.index')->with('success', 'Bairro excluído com sucesso.');
        }
        
        return redirect()->route('neighborhoods.index')->with('error', 'Bairro não encontrado.');
    }
}
