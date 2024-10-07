<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipality;
use App\Models\Province;

class MunicipalityController extends Controller
{
    public function index()
    {
        $municipalities = Municipality::all();
        return view('municipalities.index', compact('municipalities'));
    }

    public function create()
    {
        $provinces = Province::all();
        return view('municipalities.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'province_id' => 'required|integer',
        ]);
        Municipality::create($request->all());
        return redirect()->route('municipalities.index')->with('success', 'Município criado com sucesso.');
    }

    public function edit($id)
    {
        $municipality = Municipality::find($id);
        if (!$municipality) {
            return redirect()->route('municipalities.index')->with('error', 'Município não encontrado.');
        }
        $provinces = Province::all();
        return view('municipalities.create', compact('municipality', 'provinces'));
    }

    public function update(Request $request, $id)
    {
        $municipality = Municipality::find($id);
        $request->validate([
            'name' => 'required|max:255',
            'province_id' => 'required|integer',
        ]);
        if (!$municipality) {
            return redirect()->route('municipalities.index')->with('error', 'Município não encontrado.');
        }
        $municipality->update($request->all());
        return redirect()->route('municipalities.index')->with('success', 'Município atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $municipality = Municipality::find($id);
        if ($municipality){
            $municipality ->delete();
            return redirect()->route('municipalities.index')->with('success', 'Município excluído com sucesso.');
        }
        return redirect()->route('municipalities.index')->with('error', 'Município não encontrado.');
    }
}
