<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Empresa; // Certifique-se de importar o modelo Empresa

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view('departments.index',  compact('departments'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('departments.create', compact('companies') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $request->validate([
            'name'        => 'required|max:255',
            'description' => 'required|max:255',
            'company_id'  => 'required|exists:companies,id', //Garante que a empresa_id exista na tabela empresas
        ]);
        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Departamento criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::find($id);
        if (!$department) {
            return redirect()->route('departamentos.index')->with('error', 'Departamento não encontrado.');
        }
        $companies = Company::all();
        return view('departments.create', compact('companies', 'department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $department = Department::find($id);
        if (!$department) {
            return redirect()->route('departments.index')->with('error', 'Departamento não encontrado.');
        }
        $request->validate([
            'name'        => 'required|max:255',
            'description' => 'required|max:255',
            'company_id'  => 'required|exists:companies,id', //Garante que a empresa_id exista na tabela empresas
        ]);
        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', 'Departamento atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);
        if ($department) {
            $department->delete();
            return redirect()->route('departments.index')->with('success', 'Departamento excluído com sucesso.');
        }
        return redirect()->route('departments.index')->with('error', 'Departamento não encontrado.');
    }
}
