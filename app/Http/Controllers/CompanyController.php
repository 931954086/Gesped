<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'site'        => 'required|string|max:30',
            'email'       => 'required|string|max:30',
            'nif'         => 'required|string|max:14',
        ]);
        Company::create($request->all());
        return redirect()->route('companies.index')->with('success', 'Compania cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $companie = Company::find($id);
        return view('companies.create', compact('companie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'site'        => 'required|string|max:255',
            'email'       => 'required|string|max:255',
            'nif'         => 'required|string|max:14',
        ]);
        $company = Company::find($id);
        if (!$company) {
            return redirect()->route('companies.index')->with('error', 'Organização não encontrada.');
        }
        $company->update($request->all());
        return redirect()->route('companies.index')->with('success', 'Organização atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);
        if ($company){
            $company->delete();
            return redirect()->route('companies.index')->with('success', 'Organização excluída com sucesso.');
        }
        return redirect()->route('companies.index')->with('error', 'Organização não encontrada.');
    }
}
