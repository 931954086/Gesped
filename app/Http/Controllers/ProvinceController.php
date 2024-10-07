<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        return view('provinces.index', compact('provinces'));
    }

    public function create()
    {
        return view('provinces.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        Province::create($request->all());
        return redirect()->route('provinces.index')->with('success', 'Provincia criada com sucesso.');
    }

    public function edit($id)
    {
        $province = Province::find($id);
        if (!$province) {
            return redirect()->route('provinces.index')->with('error', 'Provincia não encontrada.');
        }
        return view('provinces.create', compact('province'));
    }

    public function update(Request $request, $id)
    {
        $province = Province::find($id);
        $request->validate([
            'name' => 'required|max:255',
        ]);
        if (!$province) {

            return redirect()->route('provinces.index')->with('error', 'Provincias não encontrada.');
        }
        $province->update($request->all());
        return redirect()->route('provinces.index')->with('success', 'Provincias atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $province = Province::find($id);
        if ($province){
            $province ->delete();
            return redirect()->route('provinces.index')->with('success', 'Provincias excluída com sucesso.');
        }
        return redirect()->route('provinces.index')->with('error', 'Provincia não encontrada.');
    }
}
