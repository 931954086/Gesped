<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as AccessGate;
use Illuminate\Support\Facades\Gate as FacadesGate;

class StatusController extends Controller
{
    public function index()
    {
        if (Gate::allows('admin')) {
            $statuses = Status::all();
            return view('status.index', compact('statuses'));
        } else {
            abort(403, 'NÃO TENS PERMISSÃO PARA ACEDER ESTE CONTEÚDO!');
        }
    }

    public function create()
    {
        if (Gate::allows('admin')) {
            $statuses = Status::all();
            return view('status.create', compact('statuses'));
        } else {
            abort(403, 'NÃO TENS PERMISSÃO PARA ACEDER ESTE CONTEÚDO!');
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'desc' => 'nullable|string|max:255',
        ]);

        Status::create($data);

        return redirect()->route('status.index')
            ->with('success', 'Status criado com sucesso.');
    }

    public function show($id)
    {
        if (Gate::allows('admin')) {
            $status = Status::findOrFail($id);
            return view('status.show', compact('status'));
        } else {
            abort(403, 'NÃO TENS PERMISSÃO PARA ACEDER ESTE CONTEÚDO!');
        }
    }

    public function edit($id)
    {
        if (Gate::allows('admin')) {
            $status = Status::findOrFail($id);
            return view('status.create', compact('status'));
        } else {
            abort(403, 'NÃO TENS PERMISSÃO PARA ACEDER ESTE CONTEÚDO!');
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'desc' => 'nullable|string|max:255',
        ]);

        $status = Status::findOrFail($id);
        $status->update($data);

        return redirect()->route('status.index')
            ->with('success', 'Status atualizado com sucesso.');
    }

    public function destroy($id)
    {
        if (Gate::allows('admin')) {
        $status = Status::findOrFail($id);
        $status->delete();

        return redirect()->route('status.index')
            ->with('success', 'Status excluído com sucesso.');
        } else {
            abort(403, 'NÃO TENS PERMISSÃO PARA ACEDER ESTE CONTEÚDO!');
        }
    }
}
