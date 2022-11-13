<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Paciente;
use Carbon\Carbon;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::get()->toQuery()->orderBy('nombre', 'asc')->paginate(10);

        return view('pacientes')->with('pacientes', $pacientes);
    }

    public function create()
    {
        return view('crear');
    }

    public function store(Request $request)
    {
       // dd($request->all());

        $paciente = new Paciente($request->except("nfecha"));
        $paciente->nfecha = Carbon::createFromFormat('m/d/Y', $request->nfecha)->format('Y-m-d');
        $paciente->save();
        return Redirect::to('index');
    }

    public function destroy($id)
    {
        Paciente::find($id)->delete();
        return Redirect::to('index');

    }

    public function edit($id)
    {
        $paciente = Paciente::find($id);
        //dd($paciente);
        return view('edit')->with('paciente',$paciente)->with('id',$id);

    }

    public function update(Request $request, $id)
    {
        $paciente = Paciente::find($id);
        $paciente->fill($request->except("nfecha"));
        $paciente->nfecha = Carbon::createFromFormat('m/d/Y', $request->nfecha)->format('Y-m-d');
        $paciente->update();
        return Redirect::to('index');

    }
}
