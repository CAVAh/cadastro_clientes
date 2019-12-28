<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Estado;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CidadeController extends CustomController
{
    protected $title = 'Cidade';
    protected $prefix = 'cidade';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $values = DB::table('cidades')
            ->join('estados', 'estados.id', '=', 'cidades.estado_id')
            ->join('paises', 'paises.id', '=', 'estados.pais_id')
            ->selectRaw('cidades.*, estados.nome as estado, paises.nome as pais')->paginate();

        return parent::viewItems('layouts.index', $values->items());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $estados = Estado::all(['id', 'nome']);

        return parent::view($this->prefix . '.create', ['estados' => $estados]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'    => 'bail|required|max:50|min:3',
            'ddd'      => 'bail|required|max:2|min:2',
            'estado_id' => 'bail|required|exists:estados,id',
            'cep_padrao' => 'integer|max:8',
            'cod_ibge' => 'integer|max:5'
        ]);

        $cidade = new Cidade([
            'nome'    => $request->get('nome'),
            'ddd'      => $request->get('ddd'),
            'estado_id' => $request->get('estado_id'),
            'cep_padrao' => $request->get('cep_padrao'),
            'cod_ibge' => $request->get('cod_ibge')
        ]);

        $cidade->save();
        return redirect('/' . $this->prefix)->with('success', __('Record added!'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Cidade $cidade
     * @return Response
     */
    public function edit(Cidade $cidade)
    {
        $estados = Estado::all(['id', 'nome']);

        return parent::view($this->prefix . '.edit', compact('cidade', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Cidade $cidade
     * @return Response
     */
    public function update(Request $request, Cidade $cidade)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cidade $cidade
     * @return Response
     * @throws Exception
     */
    public function destroy(Cidade $cidade)
    {
        $cidade->delete();

        return redirect('/' . $this->prefix)->with('success', __('Record deleted'));
    }
}
